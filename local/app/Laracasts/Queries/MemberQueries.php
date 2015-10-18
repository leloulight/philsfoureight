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
				HAVING NOT A.type = 'sub' AND NOT A.type = 'admin'
				ORDER BY A.id DESC";
		
		$result = DB::table('member_list')->paginate(15);
		return $result;
	}

	public function getMemberInfo($id){
		$sql = "SELECT A.id, A.firstname, A.middlename, A.lastname, A.suffix, A.street_address, A.email, A.mobileno, A.phoneno, A.birthdate,
				CASE A.gender WHEN 'm' THEN 'Male' ELSE 'Female' END AS gender,
				C.name AS city_name,
				D.name AS province_name,
				CONCAT(B.firstname, ' ' , B.middlename, ' ' , B.lastname, ' ' , B.suffix) AS sponsor_name,
				A.accountno, A.username,
				A.money, A.created_at,
				(SELECT SUM(money) FROM members WHERE main_id = A.id) AS sub_money
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
}
