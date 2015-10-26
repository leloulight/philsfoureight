<?php
namespace Laracasts\Queries;
use DB;
use Illuminate\Pagination\Paginator;

class TransactionQueries{

	public function getAdminTransactions() {
		$result = DB::table('money_log')
						->where('member_id', '=', 10000)
						->orderBy('created_at', 'desc')
						->orderBy('id', 'desc')
						->paginate(15);
		return $result;
	}

	public function getAdminTransactionSummary() {
		$sql = "SELECT
				(SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE id = 10000) AS NAME,
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = 10000 AND TYPE = 'referral-debit') AS referral_credit,
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = 10000 AND TYPE = 'reward-debit') AS reward_program,
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = 10000 AND TYPE = 'unilevel-debit') AS unilevel_bonus,
				(0) AS unilevel_transaction";
		
		$result = DB::select($sql);
		return $result;
	}
}
