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
            if ($row->process_type == "member") {
                $row->typeSpan = "<span class=\"badge bg-blue\">" . ucfirst($row->process_type) . "</span>";
            } elseif ($row->process_type == "sub") {
                $row->typeSpan = "<span class=\"badge bg-yellow\">" . ucfirst($row->process_type) . "</span>";
            } elseif ($row->process_type == "stockist") {
                $row->typeSpan = "<span class=\"badge bg-gray\">" . ucfirst($row->process_type) . "</span>";
            } else {
                $row->typeSpan = $row->process_type;
            }
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

            if ($row->type == "member") {
                $row->typeSpan = "<span class=\"badge bg-blue\">" . ucfirst($row->type) . "</span>";
            } elseif ($row->type == "sub") {
                $row->typeSpan = "<span class=\"badge bg-yellow\">" . ucfirst($row->type) . "</span>";
            } elseif ($row->type == "stockist") {
                $row->typeSpan = "<span class=\"badge bg-gray\">" . ucfirst($row->type) . "</span>";
            } else {
                $row->typeSpan = $row->process_type;
            }
        }
    	return view('pages.reward.pending', compact('reward', 'level'));
    }

    public function completed($level) {
        if ((int)$level == 0){ return view('pages.404'); }
        if ($level > 5 || $level < 1){ return view('pages.404'); }

        $reward = $this->rewardQueries->getCompleted($level);
        
        $row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($reward as &$row){
            $row->row_num = $row_num += 1;

            switch ($level) {
                case 1: $row->completed_at = $this->rewardValidations->formatDate($row->unity_one_status_at); break;
                case 2: $row->completed_at = $this->rewardValidations->formatDate($row->unity_two_status_at); break;
                case 3: $row->completed_at = $this->rewardValidations->formatDate($row->unity_three_status_at); break;
                case 4: $row->completed_at = $this->rewardValidations->formatDate($row->unity_four_status_at); break;
                case 5: $row->completed_at = $this->rewardValidations->formatDate($row->unity_five_status_at); break;
            }

            if ($row->type == "member") {
                $row->typeSpan = "<span class=\"badge bg-blue\">" . ucfirst($row->type) . "</span>";
            } elseif ($row->type == "sub") {
                $row->typeSpan = "<span class=\"badge bg-yellow\">" . ucfirst($row->type) . "</span>";
            } elseif ($row->type == "stockist") {
                $row->typeSpan = "<span class=\"badge bg-gray\">" . ucfirst($row->type) . "</span>";
            } else {
                $row->typeSpan = $row->process_type;
            }
        }
        return view('pages.reward.completed', compact('reward', 'level'));
    }
}