<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;
use Auth;

class NetworkValidations{

	public function formatDate($date) {
		$date = strtotime($date);
		return date("M d, Y", $date);
	}

	public function formatName($name) {
		$length = strlen($name);
		if ($length >= 18) {
			$name = substr($name, 0, 18) . "...";
		}
		return $name;
	}

	public function formatTypeCase($type) {
		return ucfirst($type);
	}

	public function setBadgeType($type) {
		switch ($type) {
			case 'Stockist': return 'bg-gray'; break;
			case 'Member': return 'bg-blue'; break;
			case 'Sub': return 'bg-yellow'; break;
		}
	}

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
	
}