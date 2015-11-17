<?php
namespace Laracasts\Validations;
use Validator;
use Illuminate\Foundation\Validation as valid;
use Auth;
use Laracasts\Queries\RemittanceQueries as remittanceQueries;

class RemittanceValidations{

	private $remittanceQueries;

	public function __construct() {
        $this->remittanceQueries = new remittanceQueries;
    }

	public function validateRemittancePost(array $data) {
		$attributeNames = array(
		   	'accountno' => 'Account No.',
		   	'memberid' => 'Member Id',
		   	'amount' => 'Amount',
		   	'note' => 'Note'
		);

		$validator = Validator::make($data,[
			'accountno' => 'required|exists:members,accountno|max:50',
			'memberid' => 'required|exists:members,username|max:50',
			'amount' => 'required|numeric|between:1,30000',
			'note' => 'max:150'
		]);
		$validator->setAttributeNames($attributeNames);

		if ($data['accountno'] != NULL && $data['memberid'] != NULL) {
			$validator->after(function ($validator) use ($data) {
				$valid = $this->remittanceQueries->validAccNoUsername($data['accountno'], $data['memberid']);
				if ($valid == false) {
					$validator->errors()->add('memberid', 'Account No. and Member Id doesn\'t match.');
				}

				if ($data['accountno'] == Auth::user()->accountno && $data['memberid'] == Auth::user()->username) {
					$validator->errors()->add('memberid', 'Account No. and Member Id is invalid.');
				}

				if (($data['amount'] + $data['fee']) > Auth::user()->money) {
					$validator->errors()->add('amount', 'Insufficient funds. Remittance Fee: ' . $data['fee']);
				}
			});
		}
		return $validator;
	}
}