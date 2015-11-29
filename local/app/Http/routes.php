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
// PAGE NOT FOUND
Route::get('404', function() { return view('pages.404'); } );
// WEB
Route::get('/', function() { return view('pages.index'); });
Route::get('about', function() { return view('pages.about'); });

// DASHBOARD
Route::get('dashboard','DashboardController@index');
// AUTHENTICATION : GET
Route::get('login', 'Auth\AuthController@getLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
// AUTHENTICATION : POST
Route::post('login', 'Auth\AuthController@postLogin');
// API
Route::get('api/bills_main','ApiController@getBillsMainJson');
Route::get('api/bills_sub/{id?}','ApiController@getBillsSubJson');
// BILLS : GET
Route::get('bills/{id}/{sub}','BillsController@index');
// BILLS : POST
Route::post('bills/invoice','BillsController@postInvoice');
Route::post('bills/submit','BillsController@store');
// REMITTANCE : GET
Route::get('remittance','RemittanceController@index');
// REMITTANCE : POST
Route::post('remittance/invoice','RemittanceController@postInvoice');
Route::post('remittance/submit','RemittanceController@store');