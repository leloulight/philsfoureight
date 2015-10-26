<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;
use Laracasts\Queries\RegistrationQueries as registrationQueries;

class RegistrationValidations {

	private $registrationQueries;

	public function __construct() {
        $this->registrationQueries = new registrationQueries;
    }

	public function validateRegistrationPost(array $data){
		$attributeNames = array(
		   	'firstname' => 'First Name',
		   	'middlename' => 'Middle Name',
			'lastname' => 'Last Name',
			'suffix' => 'Suffix',
			'email' => 'Email',
			'mobileno' => 'Mobile No.',
			'phoneno' => 'Phone No.',
			'birthdate' => 'Birthdate',
			'street' => 'Street Address',
			'sponsor_id' => 'Sponsor Id',
			'accountno' => 'Account No.',
			'username' => 'Username',
			'password' => 'Password',
			'password_confirmation' => 'Confirm Password',
			'placement_id' => 'Placement Id'
		);

		// Clean Mobile No. data-mask field
		$data['mobileno'] = str_replace('_', '', $data['mobileno']);

		// Cleans Phone No. data-mask field
		$data['phoneno'] = str_replace('_', '', $data['phoneno']);

		// Get Stockist ID
		$data['stockist_id'] = $this->registrationQueries->getStockistId($data['accountno']);

		$messages = array( 
			'min' => 'The :attribute is invalid.',
			'regex' => 'The :attribute must be alphabet and space only.',
			'confirmed' => 'Confirm Password does not match.'
		);

		$validator = Validator::make($data,[
			'firstname' => 'required|min:2|max:25|regex:/^[\pL\s]+$/u', // /^[\pL\s]+$/u  => Alpha Space
			'middlename' => 'required|min:2|max:25|regex:/^[\pL\s]+$/u',
			'lastname' => 'required|min:2|max:25|regex:/^[\pL\s]+$/u',
			'suffix' => 'max:20|regex:/^[\pL\s]+$/u',
			'email' => 'required|unique:members,email',
			'mobileno' => 'required|unique:members,mobileno|min:13',
			'phoneno' => 'min:14',
			'birthdate' => 'required|date',
			'street_address' => 'required|min:2|max:100',
			'sponsor_id' => 'exists:members,username',
			'accountno' => 'required|unique:members,accountno|digits_between:10,12|exists:account_numbers,accountno',
			'username' => 'required|unique:members,username|alpha_num|min:5|max:12',
			'password' => 'required|alpha_num|confirmed|min:5|max:18',
			'password_confirmation' => 'required'
		], $messages);
		$validator->setAttributeNames($attributeNames);
		
		// if ($data['sponsor_id'] != NULL) {
		// 	$validator->after(function ($validator) use ($data) {
		// 		$this->validateSponsorId($data['sponsor_id'], $validator, $data['stockist_id']);
		// 	});
		// }

		if ($data['placement_id'] != NULL) {
			$validator->after(function ($validator) use ($data) {
				$this->validatePlacementId($data['placement_id'], $validator, $data['stockist_id']);
			});
		}
		
		if ($data['stockist_id'] == NULL || $data['stockist_id'] == 10000) {
			$validator->after(function ($validator) {
				$validator->errors()->add('accountno', 'The Account No. is invalid.');
			});
		}
		

		return $validator;
	}

	public function validateStockistPost(array $data){
		$attributeNames = array(
		   	'firstname' => 'First Name',
		   	'middlename' => 'Middle Name',
			'lastname' => 'Last Name',
			'suffix' => 'Suffix',
			'email' => 'Email',
			'mobileno' => 'Mobile No.',
			'phoneno' => 'Phone No.',
			'birthdate' => 'Birthdate',
			'street' => 'Address',
			'accountno' => 'Account No.',
			'username' => 'Username',
			'password' => 'Password',
			'password_confirmation' => 'Confirm Password'
		);

		// Clean Mobile No. data-mask field
		$data['mobileno'] = str_replace('_', '', $data['mobileno']);

		// Cleans Phone No. data-mask field
		$data['phoneno'] = str_replace('_', '', $data['phoneno']);

		$messages = array( 
			'min' => 'The :attribute is invalid.',
			'regex' => 'The :attribute must be alphabet and space only.',
			'confirmed' => 'Confirm Password does not match.'
		);

		$validator = Validator::make($data,[
			'firstname' => 'required|min:2|max:25|regex:/^[\pL\s]+$/u', // /^[\pL\s]+$/u  => Alpha Space
			'middlename' => 'required|min:2|max:25|regex:/^[\pL\s]+$/u',
			'lastname' => 'required|min:2|max:25|regex:/^[\pL\s]+$/u',
			'suffix' => 'max:20|regex:/^[\pL\s]+$/u',
			'email' => 'required|unique:members,email',
			'mobileno' => 'required|unique:members,mobileno|min:13',
			'phoneno' => 'min:14',
			'birthdate' => 'required|date',
			'street_address' => 'required|min:2|max:100',
			'username' => 'required|unique:members,username|alpha_num|min:5|max:12',
			'password' => 'required|alpha_num|confirmed|min:5|max:18',
			'password_confirmation' => 'required'
		], $messages);
		$validator->setAttributeNames($attributeNames);
		
		$validator->after(function ($validator) use ($data) {
			$this->validateStockistAccountNo($data['accountno'], $validator);
		});

		return $validator;
	}

	public function validateSubPost(array $data){
		$attributeNames = array(
			'accountno' => 'Account No.',
			'username' => 'Username',
			'placement_id' => 'Placement Id',
			'sponsor_id' => 'Sponsor Id'
		);

		// Get Stockist ID
		$data['stockist_id'] = $this->registrationQueries->getStockistId($data['accountno']);

		$validator = Validator::make($data,[
			'accountno' => 'required|exists:members,accountno',
			'username' => 'required|exists:members,username',
			'placement_id' => 'required|exists:members,username',
			'sponsor_id' => 'required|exists:members,username'
		]);

		$validator->setAttributeNames($attributeNames);
		
		$validator->after(function ($validator) use ($data) {
			$this->validateAccountNoUsername($data['accountno'], $data['username'], $validator);
		});

		$validator->after(function ($validator) use ($data) {
			$this->validatePlacementId($data['placement_id'], $validator, $data['stockist_id']);
		});

		return $validator;
	}

	public function validateAccountNoUsername($accountno, $username, $validator) {
		$valid = $this->registrationQueries->checkAccountNoUsername($accountno, $username);
		if ($valid == false) {
			$validator->errors()->add('accountno', "Account No. and Username doesn't match");
		}
	}

	public function validateStockistAccountNo($accountno, $validator) {
		$result = $this->registrationQueries->validStockistRegAccoutnNo($accountno);
		if ($result == false) {
			$validator->errors()->add('accountno', 'Account No. already belongs to another stockist.');
		}
	}
	public function validateSponsorId($id, $validator, $stockist_id) {
		$result = $this->registrationQueries->validStockistMember($id, $stockist_id);
		if (count($result) == 0) {
        	$validator->errors()->add('sponsor_id', 'Sponsor Id is not a valid Stockist Member.');
        }
	}

	public function validatePlacementId($id, $validator, $stockist_id) {
		$result = $this->registrationQueries->validStockistMember($id, $stockist_id);
		if (count($result) == 0) {
        	$validator->errors()->add('placement_id', 'Placement Id is not a valid Stockist Member.');
        } else {
        	if ($result[0]->status == 1) {
        		$validator->errors()->add('placement_id', 'Placement Id is already active.');
        	}
        }
	}

	public function setSubId($value='') {
		$length = strlen(strval($value));

		switch($length){
			case 1: return "0000" . $value; break;
			case 2: return "000" . $value; break;
			case 3: return "00" . $value; break;
			case 4: return "0" . $value; break;
			case 5: return "" . $value; break;
		}
	}

	public function setPostNull($post) {
        $post['mobileno'] = NULL;
        $post['phoneno'] = NULL;
        $post['birthdate'] = NULL;
        $post['email'] = NULL;
        $post['street_address'] = NULL;
        $post['city'] = NULL;
        $post['province'] = NULL;
        $post['gender'] = NULL;
        $post['username'] = NULL;
        $post['password'] = NULL;
        $post['accountno'] = NULL;
    }
}