<?php
namespace Laracasts\Queries;
use DB;
class ApiQueries{

	public function getCityList($prov_id=''){
		$param = array();
		$sql = "SELECT * FROM city WHERE province_id = :prov_id";
		$param = array(":prov_id"=>$prov_id);

		try{
			$result = DB::select($sql, $param);
			return $result;
		}catch(\Exception $e){
			return false;
		}
	}

	public function getProvinceList(){
		$param = array();
		$sql = "SELECT * FROM province";
		try{
			$result = DB::select($sql, $param);
			return $result;
		}catch(\Exception $e){
			return false;
		}
	}

	public function getBarGraph() {
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
				'admin',
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND DATE_SUB(CURDATE(), INTERVAL 0 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 0 DAY) AND DATE_ADD(CURDATE(), INTERVAL 1 DAY))
				UNION
				SELECT
				'member',
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE NOT member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_SUB(CURDATE(), INTERVAL 5 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE NOT member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE NOT member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE NOT member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE NOT member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE NOT member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND DATE_SUB(CURDATE(), INTERVAL 0 DAY)),
				(SELECT IFNULL(SUM(amount), 0)  FROM money_log WHERE NOT member_id = 10000 AND created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 0 DAY) AND DATE_ADD(CURDATE(), INTERVAL 1 DAY))";
	
				$result = DB::select($sql);
				return $result;
	}
}
