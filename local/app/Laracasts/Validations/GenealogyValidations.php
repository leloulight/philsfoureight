<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;

class GenealogyValidations{

	public function formatDate($date) {
		$date = strtotime($date);
		return date("M d, Y", $date);
	}

	public function formatName($name) {
		$length = strlen($name);
		if ($length >= 12) {
			$name = substr($name, 0, 12) . "...";
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
}