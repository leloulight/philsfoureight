<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('404',
	function() {
		return view('pages.404');
	}
);

Route::get('/','DashboardController@index');

Route::get('member','MemberController@index');
Route::get('member/{id}','MemberController@info');
Route::get('member/get_list', 'MemberController@get_list');

Route::get('register', 'RegisterController@index');
Route::post('register', 'RegisterController@store');

Route::get('api/city/{prov_id?}', 'ApiController@getCityJson');
Route::get('api/province', 'ApiController@getProvinceJson');
Route::get('api/bargraph', 'ApiController@getDashboardBarGraph');

