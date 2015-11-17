<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Laracasts\Queries\BillsQueries as billsQueries;
use Laracasts\Validations\BillsValidations as billsValidations;

use Auth;
use Redirect;
use Session;
use Input;
use Cookie;

class BillsController extends Controller
{
	private $billsQueries;
    private $billsValidations;

    public function __construct() {
        $this->middleware('auth');
        $this->billsQueries = new billsQueries;
        $this->billsValidations = new billsValidations;
    }

    public function index($id, $sub) {
        $bills_main = $this->billsQueries->getBillsMain();
        $bills_sub = $this->billsQueries->getBillsSub($id);
        if (empty($bills_main) || empty($bills_sub)) { return view('pages.404'); }
        $hasPending = $this->billsQueries->hasPendingBillsPayment(Auth::user()->id);

        return view('pages.bills', compact('bills_main', 'bills_sub', 'id', 'sub', 'hasPending'));
    }

    public function store(Request $request) {

        // var_dump(Cookie::get('XSRF-TOKEN'));
        // $new = str_random(40);
        // Cookie::make('XSRF-TOKEN', str_random(40), 999);
        // var_dump($new);
        // die();
        // dd($request->all());
        $request['member_id'] = Auth::user()->id;
        $this->billsQueries->insertPayment($request->all());
        // Send SMS
        $mobileno = Auth::user()->mobileno;
        $mobileno = str_replace('-', '', $mobileno);
        $mobileno = substr_replace($mobileno, '+63', 0, 1);
        $msg = "We have received your request for payment of " . number_format($request['amount'], 2) . 
                "Please wait for our confirmation.";
        $this->billsQueries->insertMessageOut($mobileno, $msg);
        return Redirect::to('/dashboard');
    }

    public function postInvoice(Request $request) {
        $errorMessage = $this->billsValidations->validatePaymentPost($request->all());

        if ($errorMessage->fails()) {
            return redirect()->back()->withInput()->withErrors($errorMessage);
        } else {
            $data = [];
            $data['city'] = $this->billsQueries->getCityName(Auth::user()->city_id);
            $data['province'] = $this->billsQueries->getProvinceName(Auth::user()->province_id);
            $data['bills_main'] = $this->billsQueries->getBillsMainName($request['bills_main']);
            $data['bills_sub'] = $this->billsQueries->getBillsSubName($request['bills_sub']);
            return view('pages.bills.invoice', compact('request', 'data'));
        }
    }
}