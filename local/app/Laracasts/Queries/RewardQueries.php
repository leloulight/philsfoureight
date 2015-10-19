<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class RewardQueries{

	public function getList() {
		$sql = "SELECT 
				'1' AS level,
				(SELECT COUNT(id) FROM members WHERE STATUS = 1 AND unity_one_status = 0) AS pending,
				(SELECT COUNT(id) FROM members WHERE STATUS = 1 AND unity_one_status = 2) AS completed,
				IFNULL((SELECT id FROM members WHERE STATUS = 1 AND unity_one_status = 1), '--N/A--') AS process_id,
				IFNULL((SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE STATUS = 1 AND unity_one_status = 1), '--N/A--') AS process_name,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT accountno FROM members WHERE id = A.main_id)
					ELSE accountno
					END
					FROM members A
					WHERE STATUS = 1 AND unity_one_status = 1), '--N/A--') AS process_accountno,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT username FROM members WHERE id = A.main_id)
					ELSE username
					END
					FROM members A
					WHERE STATUS = 1 AND unity_one_status = 1), '--N/A--') AS process_username,
				IFNULL((SELECT TYPE FROM members WHERE STATUS = 1 AND unity_one_status = 1), '--N/A--') AS process_type
				UNION ALL
				SELECT 
				'2' AS level,
				(SELECT COUNT(id) FROM members WHERE unity_one_status = 2 AND unity_two_status = 0) AS pending,
				(SELECT COUNT(id) FROM members WHERE unity_one_status = 2 AND unity_two_status = 2) AS completed,
				IFNULL((SELECT id FROM members WHERE STATUS = 1 AND unity_two_status = 1), '--N/A--') AS process_id,
				IFNULL((SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE STATUS = 1 AND unity_two_status = 1), '--N/A--') AS process_name,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT accountno FROM members WHERE id = A.main_id)
					ELSE accountno
					END
					FROM members A
					WHERE STATUS = 1 AND unity_two_status = 1), '--N/A--') AS process_accountno,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT username FROM members WHERE id = A.main_id)
					ELSE username
					END
					FROM members A
					WHERE STATUS = 1 AND unity_two_status = 1), '--N/A--') AS process_username,
				IFNULL((SELECT TYPE FROM members WHERE STATUS = 1 AND unity_two_status = 1), '--N/A--') AS process_type
				UNION ALL
				SELECT 
				'3' AS level,
				(SELECT COUNT(id) FROM members WHERE unity_two_status = 2 AND unity_three_status = 0) AS pending,
				(SELECT COUNT(id) FROM members WHERE unity_two_status = 2 AND unity_three_status = 2) AS completed,
				IFNULL((SELECT id FROM members WHERE STATUS = 1 AND unity_three_status = 1), '--N/A--') AS process_id,
				IFNULL((SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE STATUS = 1 AND unity_three_status = 1), '--N/A--') AS process_name,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT accountno FROM members WHERE id = A.main_id)
					ELSE accountno
					END
					FROM members A
					WHERE STATUS = 1 AND unity_three_status = 1), '--N/A--') AS process_accountno,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT username FROM members WHERE id = A.main_id)
					ELSE username
					END
					FROM members A
					WHERE STATUS = 1 AND unity_three_status = 1), '--N/A--') AS process_username,
				IFNULL((SELECT TYPE FROM members WHERE STATUS = 1 AND unity_three_status = 1), '--N/A--') AS process_type
				UNION ALL
				SELECT 
				'4' AS level,
				(SELECT COUNT(id) FROM members WHERE unity_three_status = 2 AND unity_four_status = 0) AS pending,
				(SELECT COUNT(id) FROM members WHERE unity_three_status = 2 AND unity_four_status = 2) AS completed,
				IFNULL((SELECT id FROM members WHERE STATUS = 1 AND unity_four_status = 1), '--N/A--') AS process_id,
				IFNULL((SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE STATUS = 1 AND unity_four_status = 1), '--N/A--') AS process_name,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT accountno FROM members WHERE id = A.main_id)
					ELSE accountno
					END
					FROM members A
					WHERE STATUS = 1 AND unity_four_status = 1), '--N/A--') AS process_accountno,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT username FROM members WHERE id = A.main_id)
					ELSE username
					END
					FROM members A
					WHERE STATUS = 1 AND unity_four_status = 1), '--N/A--') AS process_username,
				IFNULL((SELECT TYPE FROM members WHERE STATUS = 1 AND unity_four_status = 1), '--N/A--') AS process_type
				UNION ALL
				SELECT 
				'5' AS level,
				(SELECT COUNT(id) FROM members WHERE unity_four_status = 2 AND unity_five_status = 0) AS pending,
				(SELECT COUNT(id) FROM members WHERE unity_four_status = 2 AND unity_five_status = 2) AS completed,
				IFNULL((SELECT id FROM members WHERE STATUS = 1 AND unity_five_status = 1), '--N/A--') AS process_id,
				IFNULL((SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE STATUS = 1 AND unity_five_status = 1), '--N/A--') AS process_name,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT accountno FROM members WHERE id = A.main_id)
					ELSE accountno
					END
					FROM members A
					WHERE STATUS = 1 AND unity_five_status = 1), '--N/A--') AS process_accountno,
				IFNULL((SELECT  
					CASE TYPE WHEN 'sub' THEN (SELECT username FROM members WHERE id = A.main_id)
					ELSE username
					END
					FROM members A
					WHERE STATUS = 1 AND unity_five_status = 1), '--N/A--') AS process_username,
				IFNULL((SELECT TYPE FROM members WHERE STATUS = 1 AND unity_five_status = 1), '--N/A--') AS process_type";

		$result = DB::select($sql);
		return $result;
	}

	public function getPending($level) {
		$result = NULL;
		switch ($level) {
			case 1: 
				$result = DB::table('members')
						->where('status', '=', 1)
						->where('type', '<>', 'admin')
						->where('unity_one_status', '=', 0)
						->orderby('activated_at')
						->paginate(15);
				break;
			case 2:
				$result = DB::table('members')
						->where('unity_one_status', '=', 2)
						->where('unity_two_status', '=', 0)
						->orderby('activated_at')
						->paginate(15);
				break;
			case 3:
				$result = DB::table('members')
						->where('unity_two_status', '=', 2)
						->where('unity_three_status', '=', 0)
						->orderby('activated_at')
						->paginate(15);
				break;
			case 4:
				$result = DB::table('members')
						->where('unity_three_status', '=', 2)
						->where('unity_four_status', '=', 0)
						->orderby('activated_at')
						->paginate(15);
				break;
			case 5:
				$result = DB::table('members')
						->where('unity_four_status', '=', 2)
						->where('unity_five_status', '=', 0)
						->orderby('activated_at')
						->paginate(15);
				break;

		}
		return $result;
	}
}
