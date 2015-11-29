<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class RemittanceQueries{

	public function validAccNoUsername($accountno, $username) {
		$sql = "SELECT id FROM members WHERE accountno = :accountno AND username = :username";
		$param = array(
			":accountno" => $accountno,
			":username" => $username
		);
		$result = DB::select($sql, $param);
		if (empty($result)) { return false; }
		else { return true; }
	}

	public function getCityName($id) {
		$sql = "SELECT name FROM city WHERE id = :id";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		if (count($result) == 0) {
			return ' ';
		} else {
			return $result[0]->name;
		}
	}

	public function getProvinceName($id) {
		$sql = "SELECT name FROM province WHERE id = :id";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		if (count($result) == 0) {
			return ' ';
		} else {
			return $result[0]->name;
		}
	}

	public function getReceiverInfo($accountno, $username) {
		$sql = "SELECT A.*, B.name AS city_name, C.name AS province_name
				FROM members A
				LEFT JOIN city B
				ON A.city_id = B.id
				LEFT JOIN province C
				ON A.province_id = C.id
				WHERE A.accountno = :accountno AND username = :username
				LIMIT 1";
		$param = array(
			":accountno" => $accountno,
			":username" => $username
		);
		$result = DB::select($sql, $param);
		return $result;
	}

	public function insertRemittance($data) {
		$sql = "INSERT INTO remittance (sender_id, receiver_id, amount, fee, total, note, globe_fee, phils_fee) 
				VALUES (:sender_id, :receiver_id, :amount, :fee, :total, :note, :globe_fee, :phils_fee)";
		$param = array(
			":sender_id"	=> $data['sender_id'],
			":receiver_id"	=> $data['receiver_id'],
			":amount"		=> $data['amount'],
			":fee"			=> $data['fee'],
			":globe_fee"	=> $data['globe_fee'],
			":phils_fee"	=> $data['phils_fee'],
			":total"		=> $data['total'],
			":note"		=> $data['note']
		);
		$result = DB::insert($sql, $param);
	}

	public function getMemberIdByAccNoUsername($accountno, $username) {
		$sql = "SELECT id FROM members WHERE accountno = :accountno AND username = :username";
		$param = array(
			":accountno" => $accountno,
			":username" => $username
		);
		$result = DB::select($sql, $param);
		return $result[0]->id;
	}

	public function hasPendingRemittance($id) {
		$sql = "SELECT id FROM remittance WHERE sender_id = :id AND status = 0";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		if (empty($result)) {
			return false;
		} else {
			return true;
		}
	}

	public function insertMessageOut($mobileno, $msg) {
		$sql = "INSERT INTO sms_out (mobileno, msg) VALUES (:mobileno, :msg)";
		$param = array(
			":mobileno" => $mobileno,
			":msg" => $msg
		);

		$result = DB::insert($sql, $param);
	}
}