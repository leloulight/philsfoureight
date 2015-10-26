<?php
namespace Laracasts\Queries;
use DB;
use Illuminate\Pagination\Paginator;

class MemberQueries{

	public function getMemberList(){
		// ---- member_list [view] RAW QUERY ----
		$sql = "SELECT  A.*, COUNT(B.id) AS sub FROM members A
				LEFT JOIN members B ON A.id = B.main_id
				GROUP BY A.id
				HAVING A.type != 'sub' AND A.type != 'admin'
				ORDER BY A.id DESC";
		
		$result = DB::table('members')
					->where('type', '<>', 'admin')
					->where('type', '<>', 'sub')
					->orderby('id', 'desc')
					->paginate(15);
		return $result;
	}

	public function getMemberInfo($id){
		$sql = "SELECT A.id, A.firstname, A.middlename, A.lastname, A.suffix, A.street_address, A.email, A.mobileno, A.phoneno, A.birthdate,
				CASE A.gender WHEN 'm' THEN 'Male' ELSE 'Female' END AS gender,
				C.name AS city_name,
				D.name AS province_name,
				CONCAT(B.firstname, ' ' , B.middlename, ' ' , B.lastname, ' ' , B.suffix) AS sponsor_name,
				A.accountno, A.username,
				A.money, A.created_at, A.status,
				(SELECT SUM(money) FROM members WHERE main_id = A.id) AS sub_money,
				CASE A.status 
				WHEN 0 THEN 'Account is inactive.'
				ELSE IFNULL((SELECT (LOG) FROM money_log WHERE member_id = A.id AND TYPE = 'reward-credit' ORDER BY id DESC LIMIT 1), 'Pending on Reward Program Level 1') 
				END AS reward_status,
				(SELECT COUNT(id) FROM members WHERE main_id = A.id) AS total_sub
				FROM members A
				LEFT JOIN members B
				ON A.unilevel_id = B.id
				LEFT JOIN city C
				ON A.city_id = C.id
				LEFT JOIN province D
				ON A.province_id = D.id
				WHERE A.id = :id";
		$param = array(
			":id" => $id
		);

		$result = DB::select($sql, $param);
		return $result;
	}

	public function getMemberTransactions($id) {
		$result = DB::table('money_log')
						->where('member_id', '=', $id)
						->orderBy('created_at', 'desc')
						->orderBy('id', 'desc')
						->paginate(15);
		return $result;
	}

	public function getTransactionSummary($id) {
		$sql = "SELECT
				(SELECT CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) FROM members WHERE id = :id) AS name,
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :rf_id AND TYPE = 'referral-credit') AS referral_credit,
				(
					(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :rc_id AND TYPE = 'reward-credit') - 
					(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :rd_id AND TYPE = 'reward-debit')
				) AS reward_program,
				(SELECT IFNULL(SUM(amount), 0) FROM money_log WHERE member_id = :un_id AND TYPE = 'unilevel-credit') AS unilevel_bonus,
				(0) AS unilevel_transaction";
		$param = array(
			":id"		=> $id,
			":rf_id"	=> $id,
			":rc_id"	=> $id,
			":rd_id"	=> $id,
			":un_id"	=> $id
		);

		$result = DB::select($sql, $param);
		return $result;
	}

	public function getSubInfo($id) {
		$result = DB::table('members')
						->where('main_id', '=', $id)
						->paginate(15);
		return $result;
	}

	public function getSubCount($id) {
		$sql = "SELECT COUNT(id) as sub FROM members WHERE main_id = :id";
		$param = array(
			":id" => $id
		);

		$result = DB::select($sql, $param);
		return $result[0]->sub;
	}
}
