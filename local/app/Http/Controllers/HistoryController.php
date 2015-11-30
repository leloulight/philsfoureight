<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Laracasts\Queries\HistoryQueries as historyQueries;
use Laracasts\Validations\HistoryValidations as historyValidations;

use Auth;
use Redirect;
use Session;
use Input;
use Cookie;

class HistoryController extends Controller
{
	private $historyQueries;
    private $historyValidations;

    public function __construct() {
        $this->middleware('auth');
        $this->historyQueries = new historyQueries;
        $this->historyValidations = new historyValidations;
    }

    public function commission() {
        $id = Auth::user()->id;

        $transactions = $this->historyQueries->getMemberTransactions($id);
        
        $summary = $this->historyQueries->getTransactionSummary($id);
        if ($summary[0]->name == NULL) { return view('pages.404'); }

        $summary[0]->referral_credit = $this->historyValidations->formatMoney($summary[0]->referral_credit);
        $summary[0]->reward_program = $this->historyValidations->formatMoney($summary[0]->reward_program);
        $summary[0]->unilevel_bonus = $this->historyValidations->formatMoney($summary[0]->unilevel_bonus);
        $summary[0]->unilevel_transaction = $this->historyValidations->formatMoney($summary[0]->unilevel_transaction);
        
        $row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($transactions as &$row){
            $row->row_num = $row_num += 1;
            $row->amount = $this->historyValidations->formatMoney($row->amount);
            $row->created_at = $this->historyValidations->formatDate($row->created_at);
            if ($row->amount < 0) {
                $row->amount_status = 'text-red';
            } else {
                $row->amount_status = 'text-green';
            }
        }

        return view('pages.history.commission', compact('transactions', 'summary'));
    }

}