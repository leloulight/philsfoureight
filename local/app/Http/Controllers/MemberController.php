<?php

namespace CRUD\Http\Controllers;

use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Input;
use Redirect;

use Laracasts\Queries\MemberQueries as memberQueries;
use Laracasts\Validations\MemberValidations as memberValidations;

class MemberController extends Controller {
    private $memberQueries;
    private $memberValidations;

    public function __construct() {
        $this->memberQueries = new memberQueries;
        $this->memberValidations = new memberValidations;
    }

    public function index()
    {
        $members = $this->memberQueries->getMemberList();
        $row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($members as &$row){
            $row->row_num = $row_num += 1;
            $row->money = $this->memberValidations->formatMoney($row->money);
            $row->created_at = $this->memberValidations->formatDate($row->created_at);
            $row->badgeStatus = $this->memberValidations->getStatusClass($row->status);
            $row->badgeStatusLabel = $this->memberValidations->validateStatus($row->status);
        }
        return view('pages.member', compact('members'));
    }

    public function info($id) {
        if ((int)$id == 0){ return view('pages.404'); }
        
        $member = $this->memberQueries->getMemberInfo($id);
        if (count($member) == 0) { return view('pages.404'); }

        foreach($member as &$row){
            $row->money = $this->memberValidations->formatMoney($row->money);
            $row->sub_money = $this->memberValidations->formatMoney($row->sub_money);
            $row->created_at = $this->memberValidations->formatDate($row->created_at);
            $row->badgeStatus = $this->memberValidations->getStatusClass($row->status);
            $row->badgeStatusLabel = $this->memberValidations->validateStatus($row->status);
        }
        return view('pages.member.info', compact('member'));
    }

    public function transactions($id) {
        if ((int)$id == 0){ return view('pages.404'); }
        
        $transactions = $this->memberQueries->getMemberTransactions($id);
        if (count($transactions) == 0) { return view('pages.404'); }

        $summary = $this->memberQueries->getTransactionSummary($id);
        
        $summary[0]->referral_credit = $this->memberValidations->formatMoney($summary[0]->referral_credit);
        $summary[0]->reward_program = $this->memberValidations->formatMoney($summary[0]->reward_program);
        $summary[0]->unilevel_bonus = $this->memberValidations->formatMoney($summary[0]->unilevel_bonus);
        $summary[0]->unilevel_transaction = $this->memberValidations->formatMoney($summary[0]->unilevel_transaction);
        
        $row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($transactions as &$row){
            $row->row_num = $row_num += 1;
            $row->amount = $this->memberValidations->formatMoney($row->amount);
            $row->created_at = $this->memberValidations->formatDate($row->created_at);
        }

        return view('pages.member.transactions', compact('transactions', 'summary'));
    }
}
