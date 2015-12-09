<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class DashboardQueries{

	public function getDashboardInfo($id){
		$sql = "SELECT 
				(SELECT money FROM members WHERE id = :bal_id) AS 'balance',
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE (type = 'unilevel-credit' OR type = 'referral-credit') AND member_id = :ref_id) AS 'referral_unilevel',
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE type = 'unilevel-commission' AND member_id = :com_id) AS 'commission',
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE type = 'reward-credit' AND member_id = :rew_id) AS 'reward'";
		$param = array(
			":bal_id" => $id,
			":ref_id" => $id,
			":com_id" => $id,
			":rew_id" => $id
		);
		$result = DB::select($sql, $param);
		return $result;
	}
}
