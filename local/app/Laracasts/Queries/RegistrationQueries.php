<?php
namespace Laracasts\Queries;
use DB;

class RegistrationQueries {

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
		$sql = "INSERT INTO members (firstname, middlename, lastname, suffix, mobileno, phoneno, birthdate, email, street_address, city_id, province_id, gender, unilevel_id, username, password, accountno, guid, status, type, main_id, stockist_id, upline_id) 
				VALUES(:firstname, :middlename, :lastname, :suffix, :mobileno, :phoneno, :birthdate, :email, :street_address, :city_id, :province_id, :gender, :unilevel_id, :username, :password, :accountno, :guid, :status, :type, :main_id, :stockist_id, :upline_id)";
		
		$param = array(
			":firstname"		=> $this->stringTrimUpper($post['firstname']),
			":middlename"		=> $this->stringTrimUpper($post['middlename']),
			":lastname"			=> $this->stringTrimUpper($post['lastname']),
			":suffix"			=> $this->stringTrimUpper($post['suffix']),
			":mobileno"			=> $post['mobileno'],
			":phoneno"			=> $post['phoneno'],
			":birthdate"		=> $post['birthdate'],
			":email"			=> $this->stringTrimOnly($post['email']),
			":street_address"	=> $this->stringTrimUpper($post['street_address']),
			":city_id"			=> $post['city'],
			":province_id"		=> $post['province'],
			":gender"			=> $post['gender'],
			":unilevel_id"		=> $post['sponsor_id'],
			":username"			=> $this->stringTrimOnly($post['username']),
			":password"			=> $this->stringTrimOnly($post['password']),
			":accountno"		=> $post['accountno'],
			":guid"				=> NULL,
			":status"			=> 0,
			":type"				=> (isset($post['type']) ? $post['type'] : 'member'),
			":main_id"			=> (isset($post['main_id']) ? $post['main_id'] : NULL),
			":stockist_id"		=> $post['stockist_id'],
			":upline_id"		=> $post['upline_id']
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
		$sql = $sql . " ORDER BY id, activated_at LIMIT 1";
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
		$sql = $sql . " ORDER BY id, activated_at LIMIT 1";
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

	public function getUplineList($member_id) {
		$sql = "SELECT	
					IFNULL(A.upline_id, 0) AS 'first', 
					IFNULL(B.upline_id, 0) AS 'second',
					IFNULL(C.upline_id, 0) AS 'third',
					IFNULL(D.upline_id, 0) AS 'forth',
					IFNULL(E.upline_id, 0) AS 'fifth',
					IFNULL(F.upline_id, 0) AS 'sixth',
					IFNULL(G.upline_id, 0) AS 'seventh'
				FROM members A
				LEFT JOIN members B
				ON B.id = A.upline_id
				LEFT JOIN members C
				ON C.id = B.upline_id
				LEFT JOIN members D
				ON D.id = C.upline_id
				LEFT JOIN members E
				ON E.id = D.upline_id
				LEFT JOIN members F
				ON F.id = E.upline_id
				LEFT JOIN members G
				ON G.id = F.upline_id
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
		$sql = "SELECT  
				CASE TYPE WHEN 'sub' THEN (SELECT username FROM members WHERE id = A.main_id)
				ELSE username
				END AS username
				FROM members A
				WHERE id = :id LIMIT 1";
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

	public function getStockistId($accountno){
		$sql = "SELECT stockist_id FROM account_numbers WHERE accountno = :accountno";
		$param = array(
			":accountno" => $accountno
		);

		$result = DB::select($sql, $param);
		if (count($result) == 0) {
			return NULL;
		} else {
			return $result[0]->stockist_id;
		}
	}

	public function validStockistMember($username, $stockist_id) {
		$sql = "SELECT status FROM members WHERE username = :username AND stockist_id = :stockist_id";
		$param = array(
			":username" => $username,
			":stockist_id" => $stockist_id
		);

		$result = DB::select($sql, $param);
		return $result;
	}

	public function getStockistInactive($id) {
		$sql = "SELECT id FROM members WHERE stockist_id = :id AND status = 0 ORDER BY id, created_at LIMIT 1";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		return $result[0]->id;
	}

	public function getMemberId($id) {
		$sql = "SELECT id FROM members WHERE username = :id LIMIT 1";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		return $result[0]->id;
	}

	public function getMemberBinaries($id) {
		$sql = "SELECT binary_left, binary_right FROM members WHERE id = :id";
		$param = array(
			":id" => $id
		);

		$result = DB::select($sql, $param);
		return $result;
	}

	public function updateMemberBinaryLeft($id, $member_id) {
		$sql = "UPDATE members SET binary_left = :member_id WHERE id = :id LIMIT 1";
		$param = array(
			":member_id" => $member_id,
			":id" => $id
		);
		$result = DB::update($sql, $param);
	}

	public function updateMemberBinaryRight($id, $member_id) {
		$sql = "UPDATE members SET binary_right = :member_id, status = 1, activated_at = CURRENT_TIMESTAMP WHERE id = :id LIMIT 1";
		$param = array(
			":member_id" => $member_id,
			":id" => $id
		);
		$result = DB::update($sql, $param);
	}

	public function updateAccountNumbers($accountno, $stockist_id, $member_id) {
		$sql = "UPDATE account_numbers SET member_id = :member_id, updated_at = CURRENT_TIMESTAMP WHERE accountno = :accountno AND stockist_id = :stockist_id";
		$param = array(
			":member_id" => $member_id,
			":accountno" => $accountno,
			":stockist_id" => $stockist_id
		);
		$result = DB::update($sql, $param);
	}

	public function validUplineId($id) {
		$sql = "SELECT status FROM members WHERE id = :id LIMIT 1";
		$param = array(
			":id" => $id
		);
		$result = DB::select($sql, $param);
		if ($result[0]->status == 0) {
			return true;
		} else {
			return false;
		}
	}

	public function validStockistRegAccoutnNo($accountno) {
		$sql = "SELECT * FROM account_numbers WHERE accountno = :accountno";
		$param = array(
			":accountno" => $accountno
		);
		$result = DB::select($sql, $param);
		if (count($result) == 0){
			return false;
		} else {
			if ($result[0]->stockist_id == 10000) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function updateNewStockistId($id) {
		$sql = "UPDATE members SET stockist_id = :stockist_id WHERE id = :id LIMIT 1";
		$param = array(
			":stockist_id" => $id,
			":id" => $id
		);
		$result = DB::update($sql, $param);
	}

	public function stringTrimUpper($string) {
    	$string = strtoupper($string);
    	$string = rtrim($string);
    	$string = ltrim($string);
    	return $string;
    }

    public function stringTrimOnly($string) {
    	$string = rtrim($string);
    	$string = ltrim($string);
    	return $string;
    }

    public function getAllDownlines($id) {
    	$downlines = array();
    	$sql = "SELECT id, firstname, lastname, upline_id, status, type FROM members WHERE upline_id = " . $id;
    	$bool = true;
    	$count = 0;
    	while ($bool) {
    		$result = DB::select($sql);
    		
    		foreach ($result as $key) {
	    		$downlines[$count]['id'] = $key->id;
	    		$downlines[$count]['firstname'] = $key->firstname;
	    		$downlines[$count]['lastname'] = $key->lastname;
	    		$downlines[$count]['upline_id'] = $key->upline_id;
	    		$downlines[$count]['status'] = $key->status;
	    		$count += 1;
	    	}

    		if (count($result) == 0) { $bool = false; }
	    	
	    	$sql = "SELECT id, firstname, lastname, upline_id, status, type FROM members ";
	    	for ($i=0; $i < count($result); $i++) { 
	    		if ($i==0) { 
	    			$sql .= "WHERE upline_id = " .$result[$i]->id . " ";
	    		} else {
	    			$sql .= "OR upline_id = " .$result[$i]->id . " ";
	    		}
	    	}
    	}

    	$inactive_id = NULL;
    	foreach ($downlines as $key) {
    		if ($key['status'] == 0) {
				$inactive_id = $key['id'];
				break;
			}
    	}

    	return $inactive_id;
    }

    public function checkAccountNoUsername($accountno, $username) {
    	$sql = "SELECT id FROM members WHERE accountno = :accountno AND username = :username";
    	$param = array(
    		":accountno" => $accountno,
    		":username" => $username
    	);
    	$result = DB::select($sql, $param);
    	if (count($result) == 0) {
    		return false;
    	} else {
    		return true;
    	}
    }

    public function getMemberStatus($id) {
    	$sql = "SELECT status FROM members WHERE id = :id LIMIT 1";
    	$param = array(
    		":id" => $id
    	);

    	$result = DB::select($sql, $param);
    	if ($result[0]->status == 0) {
    		return false;
    	} else {
    		return true;
    	}
    }

    public function getStockistIdByMemberId($id) {
    	$sql = "SELECT stockist_id FROM members WHERE id = :id";
    	$param = array(
    		":id" => $id
    	);
    	$result = DB::select($sql, $param);
    	return $result[0]->stockist_id;
    }

    public function getStockistCard() {
    	$sql = "SELECT accountno FROM account_numbers WHERE stockist_id = 10001 AND member_id IS NULL LIMIT 1";
    	$result = DB::select($sql);
    	if (count($result) == 0) {
    		die();
    	}
    	return $result[0]->accountno;
    }
}
