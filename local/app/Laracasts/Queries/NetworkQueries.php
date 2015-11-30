<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class NetworkQueries{

	public function getBinaryInfo($id) {
		$sql = "SELECT 
				CONCAT(A.lastname, ', ', A.firstname) AS name, A.type, A.status, A.binary_left, A.binary_right, A.created_at, A.id,
				CONCAT(B.lastname, ', ', B.firstname) AS binary_left_name, B.type AS binary_left_type, B.status AS binary_left_status, B.created_at AS binary_left_created, B.id AS binary_left_id, 
				CONCAT(C.lastname, ', ', C.firstname) AS binary_right_name, C.type AS binary_right_type, C.status AS binary_right_status, C.created_at AS binary_right_created, C.id AS binary_right_id
				FROM members A
				LEFT JOIN members B
				ON B.id = A.binary_left
				LEFT JOIN members C
				ON C.id = A.binary_right
				WHERE A.id = :id";

		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		return $result;
	}
}