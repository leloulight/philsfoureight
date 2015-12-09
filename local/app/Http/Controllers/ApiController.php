<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Response;

use Laracasts\Queries\ApiQueries as apiQueries;
use Laracasts\Validations\ApiValidations as apiValidations;

use Auth;

class ApiController extends Controller
{
    private $apiQueries;
    private $apiValidations;

    public function __construct() {
        // $this->middleware('auth');
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

    public function getDashboardBarGraph() {
        $id = Auth::user()->id;
        $bar = $this->apiQueries->getBarGraph($id);

        $data = [
            "labels" => [$bar[0]->day_1, $bar[0]->day_2, $bar[0]->day_3, $bar[0]->day_4, $bar[0]->day_5, $bar[0]->day_6, $bar[0]->day_7],
            "datasets" => array([
                "label" => "CREDIT",
                "fillColor" => "rgba(210, 214, 222, 1)",
                "strokeColor" => "rgba(210, 214, 222, 1)",
                "pointColor" => "rgba(210, 214, 222, 1)",
                "pointStrokeColor" => "#c1c7d1",
                "pointHighlightFill" => "#fff",
                "pointHighlightStroke" => "rgba(220,220,220,1)",
                "data" => [$bar[1]->day_1, $bar[1]->day_2, $bar[1]->day_3, $bar[1]->day_4, $bar[1]->day_5, $bar[1]->day_6, $bar[1]->day_7]
            ], [
                "label" => "DEBIT",
                "fillColor" => "rgba(60,141,188,0.9)",
                "strokeColor" => "rgba(60,141,188,0.8)",
                "pointColor" => "#3b8bba",
                "pointStrokeColor" => "rgba(60,141,188,1)",
                "pointHighlightFill" => "#fff",
                "pointHighlightStroke" => "rgba(60,141,188,1)",
                "data" => [$bar[2]->day_1, $bar[2]->day_2, $bar[2]->day_3, $bar[2]->day_4, $bar[2]->day_5, $bar[2]->day_6, $bar[2]->day_7]
            ])
        ];
        return response()->json($data);
    }
}
