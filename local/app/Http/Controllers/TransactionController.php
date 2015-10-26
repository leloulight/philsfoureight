<?php

namespace CRUD\Http\Controllers;

use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Input;
use Redirect;

use Laracasts\Queries\TransactionQueries as transactionQueries;
use Laracasts\Validations\TransactionValidations as transactionValidations;

class TransactionController extends Controller {
    private $transactionQueries;
    private $transactionValidations;

    public function __construct() {
        $this->transactionQueries = new transactionQueries;
        $this->transactionValidations = new transactionValidations;
    }

    public function index() {
        $transactions = $this->transactionQueries->getAdminTransactions();

        $summary = $this->transactionQueries->getAdminTransactionSummary();
        // if ($summary[0]->name == NULL) { return view('pages.404'); }

        $summary[0]->referral_credit = $this->transactionValidations->formatMoney($summary[0]->referral_credit);
        $summary[0]->reward_program = $this->transactionValidations->formatMoney($summary[0]->reward_program);
        $summary[0]->unilevel_bonus = $this->transactionValidations->formatMoney($summary[0]->unilevel_bonus);
        $summary[0]->unilevel_transaction = $this->transactionValidations->formatMoney($summary[0]->unilevel_transaction);
        
        $row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($transactions as &$row){
            $row->row_num = $row_num += 1;
            $row->amount = $this->transactionValidations->formatMoney($row->amount);
            $row->created_at = $this->transactionValidations->formatDate($row->created_at);
        }
        
        return view('pages.transaction', compact('transactions', 'summary'));
    }
}
