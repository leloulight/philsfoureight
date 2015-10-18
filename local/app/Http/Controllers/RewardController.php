<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Input;
use Redirect;

use Laracasts\Queries\RewardQueries as rewardQueries;
use Laracasts\Validations\RewardValidations as rewardValidations;

class RewardController extends Controller
{
	private $rewardQueries;
    private $rewardValidations;

    public function __construct() {
        $this->rewardQueries = new rewardQueries;
        $this->rewardValidations = new rewardValidations;
    }

    public function index() {
    	$reward = $this->rewardQueries->getList();

    	return view('pages.reward', compact('reward'));
    }

    public function pending($level) {
    	if ((int)$level == 0){ return view('pages.404'); }
    	if ($level > 5 || $level < 1){ return view('pages.404'); }

    	$reward = $this->rewardQueries->getPending($level);
    	
    	$row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($reward as &$row){
            $row->row_num = $row_num += 1;
            $row->activated_at = $this->rewardValidations->formatDate($row->activated_at);
        }
    	return view('pages.reward.pending', compact('reward', 'level'));
    }
}