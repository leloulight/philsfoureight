<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;

class TransactionValidations{
	
	public function formatMoney($money) {
		return number_format($money, 2);
	}

	public function formatDate($date) {
		$date = strtotime($date);
		return date("M-d-Y h:i A", $date);
	}
}