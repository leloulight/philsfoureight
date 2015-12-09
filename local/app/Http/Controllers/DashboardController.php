<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Laracasts\Queries\DashboardQueries as dashboardQueries;
use Laracasts\Validations\DashboardValidations as dashboardValidations;

use Auth;

class DashboardController extends Controller
{
	private $dashboardQueries;
    private $dashboardValidations;

    public function __construct() {
        $this->middleware('auth');
        $this->dashboardQueries = new dashboardQueries;
        $this->dashboardValidations = new dashboardValidations;
    }

    public function index()
    {
        $id = Auth::user()->id;
        $widget = $this->dashboardQueries->getDashboardInfo($id);

        $balance = explode('.', $widget[0]->balance); 
        $widget[0]->balance = $this->dashboardValidations->formatMoney($widget[0]->balance);
        $widget[0]->balance_dec = substr($balance[1], 0, 2);

        $referral_unilevel = explode('.', $widget[0]->referral_unilevel); 
        $widget[0]->referral_unilevel = $this->dashboardValidations->formatMoney($widget[0]->referral_unilevel);
        $widget[0]->referral_unilevel_dec = substr($referral_unilevel[1], 0, 2);

        $commission = explode('.', $widget[0]->commission); 
        $widget[0]->commission = $this->dashboardValidations->formatMoney($widget[0]->commission);
        $widget[0]->commission_dec = substr($commission[1], 0, 2);

        $reward = explode('.', $widget[0]->reward); 
        $widget[0]->reward = $this->dashboardValidations->formatMoney($widget[0]->reward);
        $widget[0]->reward_dec = substr($reward[1], 0, 2);

        return view('pages.dashboard', compact('widget'));
    }
}