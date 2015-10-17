<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Response;

use Laracasts\Queries\ApiQueries as apiQueries;

class ApiController extends Controller
{
    private $apiQueries;

    public function __construct() {
        $this->apiQueries = new apiQueries;
    }

    public function getCityJson($prov_id=1)
    {
        $city = $this->apiQueries->getCityList($prov_id);
        return response()->json($city);
    }

    public function getProvinceJson()
    {
        $province = $this->apiQueries->getProvinceList();
        return response()->json($province);
    }

    public function getDashboardBarGraph() {
        $bar = $this->apiQueries->getBarGraph();

        $data = [
            "labels" => [$bar[0]->day_1, $bar[0]->day_2, $bar[0]->day_3, $bar[0]->day_4, $bar[0]->day_5, $bar[0]->day_6, $bar[0]->day_7],
            "datasets" => array([
                "label" => "PHILS48",
                "fillColor" => "rgba(210, 214, 222, 1)",
                "strokeColor" => "rgba(210, 214, 222, 1)",
                "pointColor" => "rgba(210, 214, 222, 1)",
                "pointStrokeColor" => "#c1c7d1",
                "pointHighlightFill" => "#fff",
                "pointHighlightStroke" => "rgba(220,220,220,1)",
                "data" => [$bar[1]->day_1, $bar[1]->day_2, $bar[1]->day_3, $bar[1]->day_4, $bar[1]->day_5, $bar[1]->day_6, $bar[1]->day_7]
            ], [
                "label" => "Members",
                "fillColor" => "rgba(60,141,188,0.9)",
                "strokeColor" => "rgba(60,141,188,0.8)",
                "pointColor" => "#3b8bba",
                "pointStrokeColor" => "rgba(60,141,188,1)",
                "pointHighlightFill" => "#fff",
                "pointHighlightStroke" => "rgba(60,141,188,1)",
                "data" => [$bar[2]->day_1, $bar[2]->day_2, $bar[2]->day_3, $bar[2]->day_4, $bar[2]->day_5, $bar[2]->day_6, $bar[2]->day_7]
            ])
        ];
        // return response()->json($data);
        //header('Content-Type: application/json');
        return response()->json($data);
    }    

}
