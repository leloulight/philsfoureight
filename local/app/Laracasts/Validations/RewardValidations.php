<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;

class RewardValidations{
	
	public function formatDate($date) {
		$date = strtotime($date);
		return date("M-d-Y h:i A", $date);
	}
}