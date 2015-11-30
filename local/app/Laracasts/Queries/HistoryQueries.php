<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class HistoryQueries{

	public function getMemberTransactions($id) {
		$result = DB::table('money_log')
						->where('member_id', '=', $id)
						->orderBy('created_at', 'desc')
						->orderBy('id', 'desc')
						->paginate(15);
		return $result;
	}
	
	public function getTransactionSummary($id) {
		$sql = "SELECT
				(SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE id = :id) AS name,
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :rf_id AND TYPE = 'referral-credit') AS referral_credit,
				(
					(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :rc_id AND TYPE = 'reward-credit') - 
					(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :rd_id AND TYPE = 'reward-debit')
				) AS reward_program,
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :un_id AND TYPE = 'unilevel-credit') AS unilevel_bonus,
				(0) AS unilevel_transaction";
		$param = array(
			":id"		=> $id,
			":rf_id"	=> $id,
			":rc_id"	=> $id,
			":rd_id"	=> $id,
			":un_id"	=> $id
		);

		$result = DB::select($sql, $param);
		return $result;
	}
}