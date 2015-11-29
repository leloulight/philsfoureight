<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Laracasts\Queries\RemittanceQueries as remittanceQueries;
use Laracasts\Validations\RemittanceValidations as remittanceValidations;

use Auth;
use Redirect;

class RemittanceController extends Controller
{
	private $remittanceQueries;
    private $remittanceValidations;

    public function __construct() {
        $this->middleware('auth');
        $this->remittanceQueries = new remittanceQueries;
        $this->remittanceValidations = new remittanceValidations;
    }

    public function index() {
        $hasPending = $this->remittanceQueries->hasPendingRemittance(Auth::user()->id);
        return view('pages.remittance', compact('hasPending'));
    }

    public function postInvoice(Request $request) {
        $request['amount'] = str_replace(',', '', $request['amount']);
        $request['fee'] = $this->getFee($request['amount']);
        $errorMessage = $this->remittanceValidations->validateRemittancePost($request->all());

        if ($errorMessage->fails()) {
            return redirect()->back()->withInput()->withErrors($errorMessage);
        } else {
            $data = [];
            $data['city'] = $this->remittanceQueries->getCityName(Auth::user()->city_id);
            $data['province'] = $this->remittanceQueries->getProvinceName(Auth::user()->province_id);
            $receiver = $this->remittanceQueries->getReceiverInfo($request['accountno'], $request['memberid']);
            return view('pages.remittance.invoice', compact('request', 'data', 'receiver'));
        }
    }

    public function store(Request $request) {
        $request['sender_id'] = Auth::user()->id;
        $request['receiver_id'] = $this->remittanceQueries->getMemberIdByAccNoUsername($request['accountno'], $request['memberid']);
        $request['total'] = $request['amount'] + $request['fee'];
        $request['globe_fee'] = $request['fee'] / 2;
        $request['phils_fee'] = $request['fee'] / 2;
        $this->remittanceQueries->insertRemittance($request->all());
        // // Send SMS
        // $mobileno = Auth::user()->mobileno;
        // $mobileno = str_replace('-', '', $mobileno);
        // $mobileno = substr_replace($mobileno, '+63', 0, 1);
        // $msg = "We have received your request for remiitance on " . date("m/d/Y") . 
        //         " in the amount of " . number_format($request['amount'], 2) .
        //         ". Please wait for our confirmation.";
        // $this->remittanceQueries->insertMessageOut($mobileno, $msg);
        return Redirect::to('/dashboard');
    }

    public function getFee($amount) {
        $fee = $amount * 0.02;

        // if ($amount >= 1 && $amount <= 50) { $fee = 2; }
        // elseif ($amount >= 51 && $amount <= 100) { $fee = 3; }
        // elseif ($amount >= 101 && $amount <= 200) { $fee = 6; }
        // elseif ($amount >= 201 && $amount <= 300) { $fee = 9; }
        // elseif ($amount >= 301 && $amount <= 400) { $fee = 12; }
        // elseif ($amount >= 401 && $amount <= 500) { $fee = 15; }
        // elseif ($amount >= 501 && $amount <= 600) { $fee = 18; }
        // elseif ($amount >= 601 && $amount <= 700) { $fee = 20; }
        // elseif ($amount >= 701 && $amount <= 800) { $fee = 23; }
        // elseif ($amount >= 801 && $amount <= 900) { $fee = 26; }
        // elseif ($amount >= 901 && $amount <= 1000) { $fee = 29; }
        // elseif ($amount >= 1001 && $amount <= 1300) { $fee = 38; }
        // elseif ($amount >= 1301 && $amount <= 1500) { $fee = 43; }
        // elseif ($amount >= 1501 && $amount <= 1800) { $fee = 52; }
        // elseif ($amount >= 1801 && $amount <= 2000) { $fee = 58; }
        // elseif ($amount >= 2001 && $amount <= 2300) { $fee = 67; }
        // elseif ($amount >= 2301 && $amount <= 2500) { $fee = 72; }
        // elseif ($amount >= 2501 && $amount <= 2800) { $fee = 81; }
        // elseif ($amount >= 2801 && $amount <= 3000) { $fee = 87; }
        // elseif ($amount >= 3001 && $amount <= 3500) { $fee = 93; }
        // elseif ($amount >= 3501 && $amount <= 4000) { $fee = 113; }
        // elseif ($amount >= 4001 && $amount <= 4500) { $fee = 123; }
        // elseif ($amount >= 4501 && $amount <= 5000) { $fee = 128; }
        // elseif ($amount >= 5001 && $amount <= 6000) { $fee = 145; }
        // elseif ($amount >= 6001 && $amount <= 7000) { $fee = 155; }
        // elseif ($amount >= 7001 && $amount <= 8000) { $fee = 165; }
        // elseif ($amount >= 8001 && $amount <= 9500) { $fee = 185; }
        // elseif ($amount >= 9501 && $amount <= 10000) { $fee = 195; }
        // elseif ($amount >= 10001 && $amount <= 14000) { $fee = 210; }
        // elseif ($amount >= 14001 && $amount <= 15000) { $fee = 220; }
        // elseif ($amount >= 15001 && $amount <= 20000) { $fee = 260; }
        // elseif ($amount >= 20001 && $amount <= 30000) { $fee = 300; }

        return $fee;
    }
}