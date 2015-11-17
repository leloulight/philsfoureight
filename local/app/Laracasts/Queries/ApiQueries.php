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
}