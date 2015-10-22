<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class SettingsQueries{

	public function bulkInsertAccountNo($accountno) {
		$sql = "INSERT INTO account_numbers (accountno) 
					VALUES ";
		foreach ($accountno as $key) {
			$sql .= $key;
			if (next($accountno)==true) $sql .= " , ";
		}
		$param = array();
		$result = DB::insert($sql, $param);
	}

	public function getLastAccountNo() {
		$sql = "SELECT accountno FROM account_numbers ORDER BY id DESC LIMIT 1";
		$result = DB::select($sql);
		if (count($result) == 0) {
			return NULL;
		} else{
			return $result[0]->accountno;
		}
	}

	public function bulkSelectAccountNo($accountno) {
		$sql = "SELECT accountno FROM account_numbers WHERE ";
		foreach ($accountno as $key) {
			$sql .= "accountno = " .  $key;
			if (next($accountno)==true) $sql .= " OR ";
		}
		$result = DB::select($sql);
		return count($result);
	}

	public function getStockistList() {
		$sql = "SELECT id, firstname, lastname
				FROM members
				WHERE TYPE = 'admin' OR TYPE = 'stockist'";
		$result = DB::select($sql);
		return $result;
	}

	public function getAccountNoSummary($id) {
		$sql = "SELECT 
				(SELECT COUNT(id) FROM account_numbers WHERE stockist_id = :no) AS 'total_cards',
				(SELECT COUNT(id) FROM account_numbers WHERE stockist_id = :used AND member_id IS NOT NULL ) AS 'total_used',
				(SELECT COUNT(id) FROM account_numbers WHERE stockist_id = :unused AND member_id IS NULL ) AS 'total_unused'";
		$param = array(
			":no" => $id,
			":used" => $id,
			":unused" => $id
		);
		$result = DB::select($sql, $param);
		return $result;
	}

	public function getSummaryInfoList($id) {
		$result = DB::table('account_numbers')
					->select('account_numbers.id', 'account_numbers.accountno', 'members.firstname', 'members.middlename', 'members.lastname', 'members.suffix', 'account_numbers.updated_at')
					->leftjoin('members', 'members.id', '=', 'account_numbers.member_id')
					->where('account_numbers.stockist_id', '=', $id)
					->orderby('account_numbers.updated_at', 'DESC')
					->orderby('account_numbers.id', 'ASC')
					->paginate(15);
		return $result; 
	}
}
