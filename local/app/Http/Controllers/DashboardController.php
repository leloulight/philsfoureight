<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Laracasts\Queries\DashboardQueries as dashboardQueries;
use Laracasts\Validations\DashboardValidations as dashboardValidations;

class DashboardController extends Controller
{
	private $dashboardQueries;
    private $dashboardValidations;

    public function __construct() {
        $this->middleware('auth');
        $this->dashboardQueries = new dashboardQueries;
        $this->dashboardValidations = new dashboardValidations;
    }

    public function index()
    {
        // $geo = $this->get_lonlat("Lakadun, MASIU, LANAO DEL SUR, PHILIPPINES");
        // dd($geo);
        
        return view('pages.dashboard');
    }

    public function get_lonlat(  $addr  ) {
        try {
                $coordinates = @file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($addr) . '&sensor=true');
                $e=json_decode($coordinates);
                // call to google api failed so has ZERO_RESULTS -- i.e. rubbish address...
                if ( isset($e->status)) { if ( $e->status == 'ZERO_RESULTS' ) {echo '1:'; $err_res=true; } else {echo '2:'; $err_res=false; } } else { echo '3:'; $err_res=false; }
                // $coordinates is false if file_get_contents has failed so create a blank array with Longitude/Latitude.
                if ( $coordinates == false   ||  $err_res ==  true  ) {
                    $a = array( 'lat'=>0,'lng'=>0);
                    $coordinates  = new stdClass();
                    foreach (  $a  as $key => $value)
                    {
                        $coordinates->$key = $value;
                    }
                } else {
                    // call to google ok so just return longitude/latitude.
                    $coordinates = $e;
                    $coordinates  =  $coordinates->results[0]->geometry->location;
                }

                return $coordinates;
        }
        catch (Exception $e) {
        }
    }
}