<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Response;

use Laracasts\Queries\ApiQueries as apiQueries;
use Laracasts\Validations\ApiValidations as apiValidations;

class ApiController extends Controller
{
    private $apiQueries;
    private $apiValidations;

    public function __construct() {
        $this->middleware('auth');
        $this->apiQueries = new apiQueries;
        $this->apiValidations = new apiValidations;
    }

    public function getBillsMainJson()
    {
        $bills_main = $this->apiQueries->getBillsMain();
        return response()->json($bills_main);
    }

    public function getBillsSubJson($id=1)
    {
        $bills_sub = $this->apiQueries->getBillsSub($id);
        return response()->json($bills_sub);
    }
}
