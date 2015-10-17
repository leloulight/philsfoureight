<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;

class MemberValidations{
	/**
	 * @param  Status of the user
	 * @return Class from bootstrap
	 */
	public function getStatusClass($status) {
		switch($status){
			case 1: return "bg-green";break;
			case 0: return "bg-red";break;
		}
	}

	public function validateStatus($status) {
		switch($status){
			case 1: return "Active";break;
			case 0: return "Inactive";break;
		}
	}

	public function formatMoney($money) {
		return number_format($money, 2);
	}

	public function formatDate($date) {
		$date = strtotime($date);
		return date("M-d-Y h:i A", $date);
	}
}