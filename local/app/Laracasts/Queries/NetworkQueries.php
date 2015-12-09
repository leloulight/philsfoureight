<?php
namespace Laracasts\Queries;
use DB;
use Log;
use Illuminate\Pagination\Paginator;

class NetworkQueries{

	public function getBinaryInfo($id) {
		$sql = "SELECT 
				CONCAT(A.lastname, ', ', A.firstname) AS name, A.type, A.status, A.binary_left, A.binary_right, A.created_at, A.id, A.guid,
				CONCAT(B.lastname, ', ', B.firstname) AS binary_left_name, B.type AS binary_left_type, B.status AS binary_left_status, B.created_at AS binary_left_created, B.id AS binary_left_id,  B.guid AS binary_left_guid,
				CONCAT(C.lastname, ', ', C.firstname) AS binary_right_name, C.type AS binary_right_type, C.status AS binary_right_status, C.created_at AS binary_right_created, C.id AS binary_right_id, C.guid AS binary_right_guid
				FROM members A
				LEFT JOIN members B
				ON B.id = A.binary_left
				LEFT JOIN members C
				ON C.id = A.binary_right
				WHERE BINARY A.guid = :id";

		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		return $result;
	}

	public function getUnilevelList($id) {
		$networkList[] = NULL;
		
		// LEVEL 1
		$sql = "SELECT id, status FROM members WHERE unilevel_id = :id";
		$param = array(
			":id" => $id,
		);
		$result = DB::select($sql, $param);

		$total = count($result);
		$active = 0;
		$unilevel_id = array();

		foreach ($result as $row) {
			if($row->status == "1") {
				$active += 1;
			}
			array_push($unilevel_id, $row->id);
		}

		$networkList[0] = array("level" => 1, "total" => $total, "active" => $active);

		// LEVEL 2
		$active = 0;
		$unilevel_id = array();
		if (count($unilevel_id) > 0) {
			$sql = "SELECT id, status FROM members ";

			for ($i=0; $i < count($unilevel_id); $i++) { 
				if ($i == 0) $sql .= " WHERE ";
				$sql .= "unilevel_id = " . $unilevel_id[$i];
				if ($i < count($unilevel_id) - 1) $sql .= " OR ";
			}
			$result = DB::select($sql);

			$total = count($result);

			foreach ($result as $row) {
				if($row->status == "1") {
					$active += 1;
				}
				array_push($unilevel_id, $row->id);
			}

			$networkList[1] = array("level" => 2, "total" => $total, "active" => $active);
		} else {
			$networkList[1] = array("level" => 2, "total" => 0, "active" => 0);
		}
		
		// LEVEL 3
		$active = 0;
		$unilevel_id = array();
		if (count($unilevel_id) > 0) {
			$sql = "SELECT id, status FROM members ";

			for ($i=0; $i < count($unilevel_id); $i++) { 
				$sql .= "unilevel_id = " . $unilevel_id[$i];
				if ($i < count($unilevel_id) - 1) $sql .= " OR ";
			}
			$result = DB::select($sql);

			$total = count($result);

			foreach ($result as $row) {
				if($row->status == "1") {
					$active += 1;
				}
				array_push($unilevel_id, $row->id);
			}

			$networkList[2] = array("level" => 3, "total" => $total, "active" => $active);
		} else {
			$networkList[2] = array("level" => 3, "total" => 0, "active" => 0);
		}

		// LEVEL 4
		$active = 0;
		$unilevel_id = array();
		if (count($unilevel_id) > 0) {
			$sql = "SELECT id, status FROM members ";

			for ($i=0; $i < count($unilevel_id); $i++) { 
				if ($i == 0) $sql .= " WHERE ";
				$sql .= "unilevel_id = " . $unilevel_id[$i];
				if ($i < count($unilevel_id) - 1) $sql .= " OR ";
			}
			$result = DB::select($sql);

			$total = count($result);

			foreach ($result as $row) {
				if($row->status == "1") {
					$active += 1;
				}
				array_push($unilevel_id, $row->id);
			}

			$networkList[3] = array("level" => 4, "total" => $total, "active" => $active);
		} else {
			$networkList[3] = array("level" => 4, "total" => 0, "active" => 0);
		}

		// LEVEL 5
		$active = 0;
		$unilevel_id = array();
		if (count($unilevel_id) > 0) {
			$sql = "SELECT id, status FROM members ";

			for ($i=0; $i < count($unilevel_id); $i++) { 
				if ($i == 0) $sql .= " WHERE ";
				$sql .= "unilevel_id = " . $unilevel_id[$i];
				if ($i < count($unilevel_id) - 1) $sql .= " OR ";
			}
			$result = DB::select($sql);

			$total = count($result);

			foreach ($result as $row) {
				if($row->status == "1") {
					$active += 1;
				}
				array_push($unilevel_id, $row->id);
			}

			$networkList[4] = array("level" => 5, "total" => $total, "active" => $active);
		} else {
			$networkList[4] = array("level" => 5, "total" => 0, "active" => 0);
		}

		// LEVEL 6
		$active = 0;
		$unilevel_id = array();
		if (count($unilevel_id) > 0) {
			$sql = "SELECT id, status FROM members ";

			for ($i=0; $i < count($unilevel_id); $i++) { 
				if ($i == 0) $sql .= " WHERE ";
				$sql .= "unilevel_id = " . $unilevel_id[$i];
				if ($i < count($unilevel_id) - 1) $sql .= " OR ";
			}
			$result = DB::select($sql);

			$total = count($result);

			foreach ($result as $row) {
				if($row->status == "1") {
					$active += 1;
				}
				array_push($unilevel_id, $row->id);
			}

			$networkList[5] = array("level" => 6, "total" => $total, "active" => $active);
		} else {
			$networkList[5] = array("level" => 6, "total" => 0, "active" => 0);
		}

		// LEVEL 7
		$active = 0;
		$unilevel_id = array();
		if (count($unilevel_id) > 0) {
			$sql = "SELECT id, status FROM members ";

			for ($i=0; $i < count($unilevel_id); $i++) { 
				if ($i == 0) $sql .= " WHERE ";
				$sql .= "unilevel_id = " . $unilevel_id[$i];
				if ($i < count($unilevel_id) - 1) $sql .= " OR ";
			}
			$result = DB::select($sql);

			$total = count($result);
			

			foreach ($result as $row) {
				if($row->status == "1") {
					$active += 1;
				}
				array_push($unilevel_id, $row->id);
			}

			$networkList[6] = array("level" => 7, "total" => $total, "active" => $active);
		} else {
			$networkList[6] = array("level" => 7, "total" => 0, "active" => 0);
		}

		return $networkList;
	}

}