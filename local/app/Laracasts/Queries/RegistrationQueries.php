<?php
namespace Laracasts\Queries;
use DB;
class RegistrationQueries{

	public function insertMoneyLog($member_id, $amount, $type, $log) {
		$sql = "INSERT INTO money_log (member_id, amount, type, log) 
					VALUES (:member_id, :amount, :type, :log)";
		$param = array(
			":member_id" => $member_id,
			":amount" => $amount,
			":type" => $type,
			":log" => $log
		);
		$result = DB::insert($sql, $param);
	}
	
	public function bulkInsertMoneyLog($money_log) {
		$sql = "INSERT INTO money_log (member_id, amount, type, log) 
					VALUES ";
		foreach ($money_log as $key) {
			$sql .= $key;
			if (next($money_log)==true) $sql .= " , ";
		}

		$param = array();
		$result = DB::insert($sql, $param);
	}

	public function bulkUpdateMemberMoney($money_log_id) {
		if (count($money_log_id) == 1) {
			$sql = "UPDATE members 
					SET money = (SELECT SUM(amount) FROM money_log WHERE member_id = :member_id)
					WHERE id = :id";
			$param = array(
				":member_id" => $money_log_id[0],
				":id"		 => $money_log_id[0]	
			);
			$result = DB::update($sql, $param);
		} else {
			$sql = "UPDATE members SET money = CASE ";
			foreach ($money_log_id as $key) {
				$sql .= "WHEN id = " . $key . " THEN (SELECT SUM(amount) FROM money_log WHERE member_id = " . $key . ") ";
			}
			$sql .= "END WHERE id IN ( ";
			foreach ($money_log_id as $key) {
				$sql .= $key;
				if (next($money_log_id)==true) {
					$sql .= ", ";
				} else {
					$sql .= ") ";
				}
			}
			$param = array();
			$result = DB::update($sql, $param);
		}
	}

	public function updateMemberMoney($member_id) {
		$sql = "UPDATE members 
				SET money = (SELECT SUM(amount) FROM money_log WHERE member_id = :member_id)
				WHERE id = :id";
		$param = array(
			":member_id" => $member_id,
			":id"		 => $member_id	
		);
		$result = DB::update($sql, $param);
	}

	public function insertMainAccount($post) {
		$sql = "INSERT INTO members (firstname, middlename, lastname, suffix, mobileno, phoneno, birthdate, email, street_address, city_id, province_id, gender, unilevel_id, username, password, accountno, guid, status, type, main_id) 
				VALUES(:firstname, :middlename, :lastname, :suffix, :mobileno, :phoneno, :birthdate, :email, :street_address, :city_id, :province_id, :gender, :unilevel_id, :username, :password, :accountno, :guid, :status, :type, :main_id)";
		
		$param = array(
			":firstname"		=> $post['firstname'],
			":middlename"		=> $post['middlename'],
			":lastname"			=> $post['lastname'],
			":suffix"			=> $post['suffix'],
			":mobileno"			=> $post['mobileno'],
			":phoneno"			=> $post['phoneno'],
			":birthdate"		=> $post['birthdate'],
			":email"			=> $post['email'],
			":street_address"	=> $post['street_address'],
			":city_id"			=> $post['city'],
			":province_id"		=> $post['province'],
			":gender"			=> $post['gender'],
			":unilevel_id"		=> $post['sponsor_id'],
			":username"			=> $post['username'],
			":password"			=> $post['password'],
			":accountno"		=> $post['accountno'],
			":guid"				=> NULL,
			":status"			=> 0,
			":type"				=> (isset($post['type']) ? $post['type'] : 'member'),
			":main_id"			=> (isset($post['main_id']) ? $post['main_id'] : NULL)
		);

		try{
			$result = DB::insert($sql, $param);
		}catch(\Exception $e){
			return false;
		}
	}

	public function getLastMemberId() {
		$param = array();
		$sql = "SELECT id FROM members ORDER BY id DESC LIMIT 1";
		try{
			$result = DB::select($sql, $param);
			return $result[0]->id;
		}catch(\Exception $e){
			return false;
		}
	}

	public function getLastSubAccountId($member_id) {
		$sql = "SELECT id FROM members WHERE type = 'sub' AND main_id = :id ORDER BY id DESC LIMIT 1";
		$param = array(
			":id" => $member_id
		);
		try{
			$result = DB::select($sql, $param);
			return $result[0]->id;
		}catch(\Exception $e){
			return false;
		}
	}

	public function setUnilevelId($value) {
		if (empty($value)) {
			return '10000'; // Default Value
		} elseif (is_int($value)) {
			return $value;
		} else {
			$sql = "SELECT id FROM members WHERE username = :value AND NOT type = 'sub' LIMIT 1";
			$param = array(":value" => $value);
			try{
				$result = DB::select($sql, $param);
				return $result[0]->id;
			}catch(\Exception $e){
				return '10000';
			}
		}
	}

	public function getMemberIdUnilevel($unilevel_id) {
		$sql = "SELECT unilevel_id FROM members WHERE id = :id LIMIT 1";
		$param = array(":id" => $unilevel_id);
		try{
			$result = DB::select($sql, $param);
			return $result[0]->unilevel_id;
		}catch(\Exception $e){
			return false;
		}
	}

	public function getInactiveSubAccount($member_id) {
		$sql = "SELECT id, STATUS FROM members WHERE (id = :id AND STATUS = 0) 
				OR (main_id = :main_id AND STATUS = 0) ORDER BY id LIMIT 1";
		$param = array(
			":id" => $member_id,
			":main_id" => $member_id
		);
		try{
			$result = DB::select($sql, $param);
			return $result[0]->id;
		}catch(\Exception $e){
			return false;
		}
	}

	public function countUnilevel($member_id) {
		$sql = "SELECT COUNT(id) AS 'count' FROM members WHERE unilevel_id = :id";
		$param = array(":id" => $member_id);
		try{
			$result = DB::select($sql, $param);
			return $result[0]->count;
		}catch(\Exception $e){
			return false;
		}
	}

	public function updateMemberStatus($member_id) {
		$sql = "UPDATE members SET status = 1, activated_at = CURRENT_TIMESTAMP WHERE id = :member_id LIMIT 1";
		$param = array(
			":member_id" => $member_id
		);
		$result = DB::update($sql, $param);
	}

	public function checkUnity($unity_level) {
		$sql = "SELECT id FROM members ";
		switch($unity_level) {
			case 1: $sql = $sql . " WHERE unity_one_status = 1 "; break;
			case 2: $sql = $sql . " WHERE unity_two_status = 1 "; break;
			case 3: $sql = $sql . " WHERE unity_three_status = 1 "; break;
			case 4: $sql = $sql . " WHERE unity_four_status = 1 "; break;
			case 5: $sql = $sql . " WHERE unity_five_status = 1 "; break;
		}
		$sql = $sql . " LIMIT 1";

		$param = array();
		$result = DB::select($sql, $param);
		if (count($result) == 1) {
			return $result[0]->id;
		} else {
			return NULL;
		}
	}

	public function getUnityOneActive() {
		$sql = "SELECT id FROM members WHERE status = 1 AND NOT type = 'admin' 
				AND unity_one_status = 0 ORDER BY activated_at LIMIT 1";
		$param = array();
		$result = DB::select($sql, $param);
		if (count($result) == 1) {
			return $result[0]->id;
		} else {
			return NULL;
		}
	}

	public function updateUnityMember($unity_level, $unity_id, $member_id) {
		$sql = "UPDATE members ";
		switch($unity_level){
			case 1: $sql = $sql . " SET unity_one = :unity_id, unity_one_at = CURRENT_TIMESTAMP "; break;
			case 2: $sql = $sql . " SET unity_two = :unity_id, unity_two_at = CURRENT_TIMESTAMP  "; break;
			case 3: $sql = $sql . " SET unity_three = :unity_id, unity_three_at = CURRENT_TIMESTAMP  "; break;
			case 4: $sql = $sql . " SET unity_four = :unity_id, unity_four_at = CURRENT_TIMESTAMP  "; break;
			case 5: $sql = $sql . " SET unity_five = :unity_id, unity_five_at = CURRENT_TIMESTAMP  "; break;
		}
		$sql = $sql . "WHERE id = :id LIMIT 1";
		$param = array(
			":unity_id" => $unity_id,
			":id"		=> $member_id
		);
		$result = DB::update($sql, $param);
	}

	public function countUnityDownline($unity_level, $member_id) {
		$sql = "SELECT COUNT(id) as 'count' FROM members ";
		switch($unity_level){
			case 1: $sql = $sql . " WHERE unity_one = :id "; break;
			case 2: $sql = $sql . " WHERE unity_two = :id "; break;
			case 3: $sql = $sql . " WHERE unity_three = :id "; break;
			case 4: $sql = $sql . " WHERE unity_four = :id "; break;
			case 5: $sql = $sql . " WHERE unity_five = :id "; break;
		}
		$param = array(
			":id" => $member_id
		);
		$result = DB::select($sql, $param);
		return $result[0]->count;
	}

	public function updateUnityStatus($unity_level, $member_id, $status) {
		$sql = "UPDATE members ";
		switch($unity_level){
			case 1: $sql = $sql . " SET unity_one_status = :status, unity_one_status_at = CURRENT_TIMESTAMP "; break;
			case 2: $sql = $sql . " SET unity_two_status = :status, unity_two_status_at = CURRENT_TIMESTAMP "; break;
			case 3: $sql = $sql . " SET unity_three_status = :status, unity_three_status_at = CURRENT_TIMESTAMP "; break;
			case 4: $sql = $sql . " SET unity_four_status = :status, unity_four_status_at = CURRENT_TIMESTAMP "; break;
			case 5: $sql = $sql . " SET unity_five_status = :status, unity_five_status_at = CURRENT_TIMESTAMP "; break;
		}
		$sql = $sql . "WHERE id = :id LIMIT 1";
		$param = array(
			":id"		=> $member_id,
			":status"	=> $status
		);
		$result = DB::update($sql, $param);
	}

	public function fillUnityLevelOneMember($member_id) {
		$sql = "UPDATE members SET unity_one = :member_id WHERE NOT type = 'admin' AND NOT id = :id ORDER BY activated_at LIMIT 5";
		$param = array(
			":member_id" => $member_id,
			":id"		=> $member_id
		);
		$result = DB::update($sql, $param);
	}

	public function checkUnityAdvance($unity_level) {
		$sql = "SELECT id FROM members ";
		switch($unity_level){
			case 2: $sql = $sql . " WHERE unity_one_status = 2 AND unity_two_status = 1 "; break;
			case 3: $sql = $sql . " WHERE unity_two_status = 2 AND unity_three_status = 1 "; break;
			case 4: $sql = $sql . " WHERE unity_three_status = 2 AND unity_four_status = 1 "; break;
			case 5: $sql = $sql . " WHERE unity_four_status = 2 AND unity_five_status = 1 "; break;
		}
		$sql = $sql . " LIMIT 1";
		$param = array();
		$result = DB::select($sql, $param);
		if (count($result) == 1) {
			return $result[0]->id;
		} else {
			return NULL;
		}
	}

	public function getUnityAdvance($unity_level) {
		$sql = "SELECT id FROM members ";
		switch($unity_level){
			case 1: $sql = $sql . " WHERE unity_one_status = 1 AND STATUS = 1 AND NOT TYPE = 'admin' "; break;
			case 2: $sql = $sql . " WHERE unity_one_status = 2 AND unity_two IS NULL AND unity_two_status = 0 "; break;
			case 3: $sql = $sql . " WHERE unity_two_status = 2 AND unity_three IS NULL AND unity_three_status = 0 "; break;
			case 4: $sql = $sql . " WHERE unity_three_status = 2 AND unity_four IS NULL AND unity_four_status = 0 "; break;
			case 5: $sql = $sql . " WHERE unity_four_status = 2 AND unity_five IS NULL AND unity_five_status = 0 "; break;
		}
		$sql = $sql . " ORDER BY activated_at LIMIT 1";
		$param = array();
		$result = DB::select($sql, $param);
		if (count($result) == 1) {
			return $result[0]->id;
		} else {
			return NULL;
		}
	}

	public function getInactiveUnityAdvance($unity_level) {
		$sql = "SELECT id FROM members ";
		switch($unity_level){
			case 1: $sql = $sql . " WHERE unity_one_status = 0 AND STATUS = 1 AND NOT TYPE = 'admin' "; break;
			case 2: $sql = $sql . " WHERE unity_one_status = 2 AND unity_two_status = 0 "; break;
			case 3: $sql = $sql . " WHERE unity_two_status = 2 AND unity_three_status = 0 "; break;
			case 4: $sql = $sql . " WHERE unity_three_status = 2 AND unity_four_status = 0 "; break;
			case 5: $sql = $sql . " WHERE unity_four_status = 2 AND unity_five_status = 0 "; break;
		}
		$sql = $sql . " ORDER BY activated_at LIMIT 1";
		$param = array();
		$result = DB::select($sql, $param);
		if (count($result) == 1) {
			return $result[0]->id;
		} else {
			return NULL;
		}
	}

	public function getUnityOneMember($member_id) {
		$sql = "SELECT id FROM members WHERE unity_one IS NULL AND NOT TYPE = 'admin' AND NOT id = :id ORDER BY id LIMIT 1";
		$param = array(
			":id" => $member_id
		);
		$result = DB::select($sql, $param);
		if (count($result) == 1) {
			return $result[0]->id;
		} else {
			return NULL;
		}
	}

	public function getUnlivelList($member_id) {
		$sql = "SELECT	
					IFNULL(A.unilevel_id, 0) AS 'first', 
					IFNULL(B.unilevel_id, 0) AS 'second',
					IFNULL(C.unilevel_id, 0) AS 'third',
					IFNULL(D.unilevel_id, 0) AS 'forth',
					IFNULL(E.unilevel_id, 0) AS 'fifth',
					IFNULL(F.unilevel_id, 0) AS 'sixth',
					IFNULL(G.unilevel_id, 0) AS 'seventh'
				FROM members A
				LEFT JOIN members B
				ON B.id = A.unilevel_id
				LEFT JOIN members C
				ON C.id = B.unilevel_id
				LEFT JOIN members D
				ON D.id = C.unilevel_id
				LEFT JOIN members E
				ON E.id = D.unilevel_id
				LEFT JOIN members F
				ON F.id = E.unilevel_id
				LEFT JOIN members G
				ON G.id = F.unilevel_id
				WHERE A.id = :id";
		$param = array(
			":id" => $member_id
		);
		$result = DB::select($sql, $param);
		if (count($result) == 1) {
			$list = array($result[0]->first, $result[0]->second, $result[0]->third, $result[0]->forth, $result[0]->fifth, $result[0]->sixth, $result[0]->seventh);
			return $list;
		} else {
			return NULL;
		}
	}

	public function getMemberName($member_id) {
		$sql = "SELECT firstname, middlename, lastname, suffix, accountno, type, main_id FROM members WHERE id = :id LIMIT 1";
		$param = array(
			":id" => $member_id
		);
		$result = DB::select($sql, $param);
		$name = "";
		if (count($result) == 1) {
			if($result[0]->type == "sub") {
				$sub = $this->getSubMemberName($result[0]->main_id);
				$name .= $result[0]->firstname . " " . $result[0]->lastname . "-"  . $sub[0]->accountno . " (Sub Account)";
			} else {
				$name .= $result[0]->firstname . " " . $result[0]->lastname . "-"  . $result[0]->accountno;
			}
		} else {
			return NULL;
		}
		return $name;
	}

	public function getSubMemberName($member_id) {
		$sql = "SELECT firstname, middlename, lastname, suffix, accountno, type FROM members WHERE id = :id LIMIT 1";
		$param = array(
			":id" => $member_id
		);
		$result = DB::select($sql, $param);
		return $result;
	}

	public function getMemberUsername($member_id) {
		$sql = "SELECT username FROM members WHERE id = :id LIMIT 1";
		$param = array(
			":id" => $member_id
		);
		$result = DB::select($sql, $param);
		return $result[0]->username;
	}

	public function getLastSubAccount($member_id) {
		$sql = "SELECT SUBSTRING(firstname, -5) AS 'last_sub_id', firstname, middlename, lastname, suffix, type, main_id FROM members WHERE main_id = :member_id OR id = :id ORDER BY id DESC LIMIT 1";
		$param = array(
			":id" => $member_id,
			":member_id" => $member_id
		);

		$result = DB::select($sql, $param);
		if ($result[0]->type == "sub") {
			$replace = substr($result[0]->firstname, -6);
			$result[0]->firstname = str_replace($replace, "", $result[0]->firstname);
		}
		return $result;
	}
}
