<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;

class RegistrationValidations {

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
			'sponsor_id' => 'exists:members,username',
			'accountno' => 'required|unique:members,accountno|digits_between:10,12',
			'username' => 'required|unique:members,username|alpha_num|min:5|max:12',
			'password' => 'required|alpha_num|confirmed|min:5|max:18',
			'password_confirmation' => 'required'
		], $messages);
		$validator->setAttributeNames($attributeNames);
		
		return $validator;
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