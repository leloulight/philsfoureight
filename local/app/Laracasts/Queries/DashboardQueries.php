<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class DashboardQueries{

	public function getDashboardInfo(){
		$sql = "SELECT 
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND 
					created_at BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AS 'admin_money',
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE NOT member_id = 10000 AND 
					created_at BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AS 'member_money',
				(SELECT COUNT(id) FROM members WHERE TYPE != 'admin' AND TYPE != 'sub' AND 
					created_at BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AS 'new_registration',
				(SELECT COUNT(id) FROM money_log WHERE LOG LIKE '%Completed Reward Program%' AND 
					NOT member_id = 10000 AND created_at BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AS 'reward_complete'";
			
		$result = DB::select($sql);
		return $result;
	}

	public function latestMember() {
		$sql = "SELECT id, CONCAT(firstname, ' ', lastname) AS 'name', created_at 
				FROM members WHERE type != 'admin' AND type != 'sub' ORDER BY id DESC LIMIT 8";
		$result = DB::select($sql);
		return $result;
	}

	public function getDate() {
		$sql = "SELECT CURRENT_TIMESTAMP as 'date'";
		$result = DB::select($sql);
		return $result[0]->date;
	}

	public function getTopEarner() {
		// $sql = "SELECT A.id, CONCAT(A.firstname, ' ', A.middlename, ' ',A.lastname, ' ', IFNULL(A.suffix, '')) AS name, 
		// 		B.name AS city, C.name AS province, 
		// 		(SELECT SUM(money) FROM members WHERE id = A.id OR main_id = A.id) AS money
		// 		FROM members A 
		// 		INNER JOIN city B
		// 		ON A.city_id = B.id
		// 		INNER JOIN province C
		// 		ON A.province_id = C.id
		// 		WHERE A.type != 'admin' 
		// 		AND A.type != 'sub'
		// 		ORDER BY money DESC LIMIT 5";
		$sql = "SELECT A.id, CONCAT(A.firstname, ' ', A.middlename, ' ',A.lastname, ' ', IFNULL(A.suffix, '')) AS name, 
				B.name AS city, C.name AS province, money
				FROM members A 
				INNER JOIN city B
				ON A.city_id = B.id
				INNER JOIN province C
				ON A.province_id = C.id
				WHERE A.type != 'admin' 
				AND A.type != 'sub'
				ORDER BY money DESC";
		$result = DB::select($sql);

		$sql = "SELECT main_id, SUM(money) AS money FROM members
				WHERE TYPE = 'sub'
				GROUP BY main_id";
				
		$sub_result = DB::select($sql);
		foreach ($result as $row) {
			foreach ($sub_result as $row_sub) {
				if ($row->id == $row_sub->main_id){
					$row->money = intval($row->money) + intval($row_sub->money);
				}
			}
		}

		ksort($result);
		$result = array_slice($result, 0, 5);

		return $result;
	}

	public function getRewardCompleted() {
		$sql = "SELECT A.member_id, A.log, SUBSTRING(A.log, -2, 1) AS level,
					(SELECT 
					IFNULL(accountno, (SELECT accountno FROM members WHERE id = B.main_id))
					FROM members B WHERE B.id = A.member_id) AS accountno, 
					CONCAT(C.firstname, ' ' , C.middlename, ' ' , C.lastname, ' ' , C.suffix) AS name,
					A.created_at
				FROM money_log A
				INNER JOIN members C
				ON C.id = A.member_id
				WHERE A.type = 'reward-credit'
				ORDER BY A.created_at DESC LIMIT 7";
		$result = DB::select($sql);
		return $result;
	}
}
