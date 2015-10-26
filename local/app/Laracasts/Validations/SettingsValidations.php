<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;
use Laracasts\Queries\SettingsQueries as settingsQueries;

class SettingsValidations{
	private $settingsQueries;

    public function __construct() {
        $this->settingsQueries = new settingsQueries;
    }

	public function validateInsertAccountNoPost(array $data){
		$attributeNames = array(
		   	'no_accounts' => 'No. of Accounts'
		);
		$validator = Validator::make($data,[
			'no_accounts' => 'integer|required'
		]);
		$validator->setAttributeNames($attributeNames);

		return $validator;
	}

	public function validateAssignAccountNoPost(array $data){
		$attributeNames = array(
		   	'no_accounts' => 'No. of Accounts'
		);
		$validator = Validator::make($data,[
			'no_accounts' => 'integer|required'
		]);
		$validator->setAttributeNames($attributeNames);

		return $validator;
	}


 	public function formatDate($date) {
 		if ($date == "0000-00-00 00:00:00") { return NULL;}
		$date = strtotime($date);
		return date("M-d-Y h:i A", $date);
	}

	public function formatName($firstname, $middlename, $lastname, $suffix) {
		if ($firstname == NULL && $middlename == NULL && $lastname == NULL && $suffix == NULL) {
			return NULL;
		} else {
			return $lastname . ", " . $firstname . " " . $suffix . " " . $middlename;
		}
	}
}