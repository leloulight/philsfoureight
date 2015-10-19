<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;

class ApiValidations{
	
	public function formatMoney($money) {
		return number_format($money, 0);
	}

	public function formatMoneyDec($money) {
		return number_format($money, 2);
	}

	public function formatDate($date, $today) {
		$dStart = new \DateTime(date("Y-m-d", strtotime($date)));
		$dEnd  = new \DateTime(date("Y-m-d", strtotime($today)));

		$dDiff = $dStart->diff($dEnd);
		
		switch ($dDiff->days) {
			case 0:
				return "Today"; break;
			case 1:
				return "Yesterday"; break;
			default:
				return date("M d", strtotime($date)); break;
		}
		return $date;
	}

	public function getLevelClass($level) {
		switch($level){
			case 1: return "label-success";break;
			case 2: return "label-warning";break;
			case 3: return "label-info";break;
			case 4: return "label-primary";break;
			case 5: return "label-success";break;
		}
	}
}