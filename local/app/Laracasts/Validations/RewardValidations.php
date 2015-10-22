<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;

class RewardValidations{
	
	public function formatDate($date) {
		$date = strtotime($date);
		return date("M-d-Y h:i A", $date);
	}

	public function formatMoney($money) {
		return number_format($money, 2);
	}

	public function formatInteger($money) {
		return number_format($money, 0);
	}

	public function getTypeClass($status) {
		switch($status){
			case 'member': return "bg-blue";break;
			case 'sub': return "bg-red";break;
			case 'stockist': return "bg-gray";break;
		}
	}
}