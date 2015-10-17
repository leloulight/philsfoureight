<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Laracasts\Queries\DashboardQueries as dashboardQueries;
use Laracasts\Validations\DashboardValidations as dashboardValidations;

class DashboardController extends Controller
{
	private $dashboardQueries;
    private $dashboardValidations;

    public function __construct() {
        $this->dashboardQueries = new dashboardQueries;
        $this->dashboardValidations = new dashboardValidations;
    }

    public function index()
    {

    	$widget = $this->dashboardQueries->getDashboardInfo();

    	$admin_money = explode('.', $widget[0]->admin_money); 
		$widget[0]->admin_money = $this->dashboardValidations->formatMoney($widget[0]->admin_money);
    	$widget[0]->admin_money_dec = substr($admin_money[1], 0, 2);

    	$member_money = explode('.', $widget[0]->member_money); 
		$widget[0]->member_money = $this->dashboardValidations->formatMoney($widget[0]->member_money);
		$widget[0]->member_money_dec = substr($member_money[1], 0, 2);

		$widget[0]->new_registration = $this->dashboardValidations->formatMoney($widget[0]->new_registration);
		$widget[0]->reward_complete = $this->dashboardValidations->formatMoney($widget[0]->reward_complete);

		$today = $this->dashboardQueries->getDate();

		$latest_member = $this->dashboardQueries->latestMember();
		foreach ($latest_member as $row) {
			$row->name = ucwords(strtolower($row->name));
			$row->created_at = $this->dashboardValidations->formatDate($row->created_at, $today);
		}

        $top_earner = $this->dashboardQueries->getTopEarner();
        foreach ($top_earner as $row) {
            $row->name = ucwords(strtolower($row->name));
            $row->money = $this->dashboardValidations->formatMoneyDec($row->money);
        }

        $reward_list = $this->dashboardQueries->getRewardCompleted();
        foreach ($reward_list as &$row) {
            $row->name = ucwords(strtolower($row->name));
            $row->created_at = $this->dashboardValidations->formatDate($row->created_at, $today);
            $row->level_status = $this->dashboardValidations->getLevelClass($row->level);
        }
        return view('pages.dashboard', compact('widget', 'latest_member', 'top_earner', 'reward_list'));
    }
}