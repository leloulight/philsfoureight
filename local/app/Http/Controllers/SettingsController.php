<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Input;
use Redirect;

use Laracasts\Queries\SettingsQueries as settingsQueries;
use Laracasts\Validations\SettingsValidations as settingsValidations;

class SettingsController extends Controller
{
	private $settingsQueries;
    private $settingsValidations;

    public function __construct() {
        $this->settingsQueries = new settingsQueries;
        $this->settingsValidations = new settingsValidations;
    }

    public function accountno_summary($id='') {
        if ($id == NULL){$id = 10000;}
        if ((int)$id == 0){ return view('pages.404'); }
        
        $summary_widget = $this->settingsQueries->getAccountNoSummary($id);
        $summary_list = $this->settingsQueries->getSummaryInfoList($id);

        $stockist_list = $this->settingsQueries->getStockistList();
        $row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($summary_list as &$row) {
            $row->row_num = $row_num += 1;
            $row->updated_at = $this->settingsValidations->formatDate($row->updated_at);
            $row->name = $this->settingsValidations->formatName($row->firstname, $row->middlename, $row->lastname, $row->suffix);
        }

        return view('pages.settings.accountno.summary', compact('stockist_list', 'id', 'summary_widget', 'summary_list'));
    }

    public function accountno_assign() {
        $stockist_list = $this->settingsQueries->getStockistList();
        $start = $this->settingsQueries->getStartUnusedAccountNo();
        return view('pages.settings.accountno.assign', compact('stockist_list', 'start'));
    }

    public function accountno_generate() {
        $start = $this->settingsQueries->getLastAccountNo();

        return view('pages.settings.accountno.generate', compact('start'));
    }

    public function accountno_assign_store(Request $request) {
        $errorMessage = $this->settingsValidations->validateAssignAccountNoPost($request->all());
        
        if ($errorMessage->fails()) {
            return Redirect::to('settings/accountno/assign')->withInput()->withErrors($errorMessage);
        } else {
            $this->assignAccountNo($request);
            return Redirect::to('/');
        }
    }

    public function assignAccountNo($post) {
        $start = (int)$post['last_accountno'];
        $no_accounts = (int)$post['no_accounts'];

        $start_accountno_id = $this->settingsQueries->getAccountNoId($start);
        $last_accountno_id = $start_accountno_id + $no_accounts;

        $this->settingsQueries->assignAccountNoUpdate($start_accountno_id, $last_accountno_id, $post['stockist_list']);
    }

    public function accountno_generate_store(Request $request) {
        $errorMessage = $this->settingsValidations->validateInsertAccountNoPost($request->all());
        
        if ($errorMessage->fails()) {
            return Redirect::to('settings/accountno/generate')->withInput()->withErrors($errorMessage);
        } else {
            $this->insertAccountNo($request);
            return Redirect::to('/');
        }
    }

    public function insertAccountNo($post) {
        $last = (int)$post['last_accountno'];
        $no_accounts = (int)$post['no_accounts'];
        
        $accountno_insert = array();
        for ($i=$last; $i < $last + $no_accounts; $i++) { 
            $accountno_insert = $this->pushAccountNo($i + 1, $accountno_insert);
        }
        // Insert Bulk Account No.
        $this->settingsQueries->bulkInsertAccountNo($accountno_insert);
    }

    public function pushAccountNo($accountno, $accountno_insert) {
        $var = "(" . $accountno . ")";
        array_push($accountno_insert, $var);
        return $accountno_insert;
    }
}