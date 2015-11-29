<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class BillsQueries{

	public function getBillsMain() {
		$sql = "SELECT * FROM bills_main";
		$result = DB::select($sql);
		return $result;
	}

	public function getBillsSub($id) {
		$sql = "SELECT * FROM bills_sub WHERE bills_main_id = :id";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		return $result;
	}

	public function getCityName($id) {
		$sql = "SELECT name FROM city WHERE id = :id";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		if (count($result) == 0) {
			return NULL;
		}
		return $result[0]->name;
	}

	public function getProvinceName($id) {
		$sql = "SELECT name FROM province WHERE id = :id";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		if (count($result) == 0) {
			return NULL;
		}
		return $result[0]->name;
	}

	public function getBillsMainName($id) {
		$sql = "SELECT name FROM bills_main WHERE id = :id";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		return $result[0]->name;
	}

	public function getBillsSubName($id) {
		$sql = "SELECT name FROM bills_sub WHERE id = :id";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		return $result[0]->name;
	}

	public function insertPayment($data) {
		$sql = "INSERT INTO bills_payment (bills_main_id, bills_sub_id, reference_no, amount, total, note, member_id)
				VALUES (:bills_main_id, :bills_sub_id, :reference_no, :amount, :total, :note, :member_id)";
		$param = array(
			":bills_main_id"	=> $data['bills_main'],
			":bills_sub_id"		=> $data['bills_sub'],
			":reference_no"		=> $data['refno'],
			":amount"			=> $data['amount'],
			":total"			=> $data['amount'] + 10,
			":note"				=> $data['note'],
			":member_id"		=> $data['member_id']
		);

		$result = DB::insert($sql, $param);
	}

	public function hasPendingBillsPayment($id) {
		$sql = "SELECT id FROM bills_payment WHERE member_id = :id AND status = 0";
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
		$sql = "INSERT INTO messageout (MessageTo, MessageText) VALUES (:mobileno, :msg)";
		$param = array(
			":mobileno" => $mobileno,
			":msg" => $msg
		);

		$result = DB::connection('smsserver')->insert($sql, $param);
	}
}