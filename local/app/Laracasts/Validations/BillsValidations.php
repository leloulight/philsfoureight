<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;
use Auth;

class BillsValidations{

	public function validatePaymentPost(array $data) {
		$attributeNames = array(
		   	'refno' => 'Reference No.',
		   	'amount' => 'Amount',
		   	'note' => 'Note'
		);

		$validator = Validator::make($data,[
			'refno' => 'required|min:4|max:50',
			'amount' => 'required|numeric|between:1,' . (Auth::user()->money - 10),
			'note' => 'max:150'

		]);
		$validator->setAttributeNames($attributeNames);

		return $validator;
	}
}