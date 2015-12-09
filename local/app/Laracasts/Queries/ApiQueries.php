<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class ApiQueries{

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


	public function getBarGraph($id) {
		$sql = "SELECT 
				'date' AS 'type', 
				DATE_SUB(CURDATE(), INTERVAL 6 DAY) AS 'day_1', 
				DATE_SUB(CURDATE(), INTERVAL 5 DAY) AS 'day_2', 
				DATE_SUB(CURDATE(), INTERVAL 4 DAY) AS 'day_3', 
				DATE_SUB(CURDATE(), INTERVAL 3 DAY) AS 'day_4', 
				DATE_SUB(CURDATE(), INTERVAL 2 DAY) AS 'day_5', 
				DATE_SUB(CURDATE(), INTERVAL 1 DAY) AS 'day_6', 
				DATE_SUB(CURDATE(), INTERVAL 0 DAY) AS 'day_7'
				UNION
				SELECT 
				'credit',
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = :credit_1 AND TYPE LIKE '%credit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = :credit_2 AND TYPE LIKE '%credit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = :credit_3 AND TYPE LIKE '%credit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = :credit_4 AND TYPE LIKE '%credit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = :credit_5 AND TYPE LIKE '%credit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = :credit_6 AND TYPE LIKE '%credit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND DATE_SUB(CURDATE(), INTERVAL 0 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = :credit_7 AND TYPE LIKE '%credit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 0 DAY) AND DATE_ADD(CURDATE(), INTERVAL 1 DAY))
				UNION
				SELECT
				'debit',
				(SELECT (IFNULL(SUM(amount), 0) * -1)  FROM money_log WHERE member_id = :debit_1 AND TYPE LIKE '%debit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY)),
				(SELECT (IFNULL(SUM(amount), 0) * -1)  FROM money_log WHERE member_id = :debit_2 AND TYPE LIKE '%debit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
				(SELECT (IFNULL(SUM(amount), 0) * -1)  FROM money_log WHERE member_id = :debit_3 AND TYPE LIKE '%debit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
				(SELECT (IFNULL(SUM(amount), 0) * -1)  FROM money_log WHERE member_id = :debit_4 AND TYPE LIKE '%debit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
				(SELECT (IFNULL(SUM(amount), 0) * -1)  FROM money_log WHERE member_id = :debit_5 AND TYPE LIKE '%debit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
				(SELECT (IFNULL(SUM(amount), 0) * -1)  FROM money_log WHERE member_id = :debit_6 AND TYPE LIKE '%debit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND DATE_SUB(CURDATE(), INTERVAL 0 DAY)),
				(SELECT (IFNULL(SUM(amount), 0) * -1)  FROM money_log WHERE member_id = :debit_7 AND TYPE LIKE '%debit' AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 0 DAY) AND DATE_ADD(CURDATE(), INTERVAL 1 DAY))";
		$param = array(
			":credit_1" => $id,
			":credit_2" => $id,
			":credit_3" => $id,
			":credit_4" => $id,
			":credit_5" => $id,
			":credit_6" => $id,
			":credit_7" => $id,
			":debit_1" => $id,
			":debit_2" => $id,
			":debit_3" => $id,
			":debit_4" => $id,
			":debit_5" => $id,
			":debit_6" => $id,
			":debit_7" => $id,
		);
		$result = DB::select($sql, $param);
		return $result;
	}
}