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
    	foreach($reward as &$row){
    		$distributed = 0;
    		$sub = 0;
    		switch ($row->level) {
    			case 1: $distributed = 500; $sub = 0; break;
    			case 2: $distributed = 2500 - 1000; $sub = 2; break;
    			case 3: $distributed = 7000 - 2000; $sub = 4; break;
    			case 4: $distributed = 30000 - 4000; $sub = 8; break;
    			case 5: $distributed = 70000 - 8000; $sub = 16; break;
    		}
            $row->distributed = $this->rewardValidations->formatMoney($distributed * $row->completed);
            $row->sub = $this->rewardValidations->formatInteger($sub * $row->completed);
        }
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