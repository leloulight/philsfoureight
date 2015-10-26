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

// DASHBOARD
Route::get('/','DashboardController@index');
// MEMBER
Route::get('member','MemberController@index');
Route::get('member/{id}','MemberController@info');
Route::get('member/{id}/transactions','MemberController@transactions');
Route::get('member/{id}/sub','MemberController@sub_info');
Route::get('member/get_list', 'MemberController@get_list');
// REGISTER : GET
Route::get('register/member', 'RegisterController@register_member');
Route::get('register/sub', 'RegisterController@register_sub');
Route::get('register/stockist', 'RegisterController@register_stockist');
// REGISTER : POST
Route::post('register/member', 'RegisterController@store_member');
Route::post('register/sub', 'RegisterController@store_sub');
Route::post('register/stockist', 'RegisterController@store_stockist');
// REWARD
Route::get('reward','RewardController@index');
Route::get('reward/pending/{level}','RewardController@pending');
Route::get('reward/completed/{level}','RewardController@completed');
// SETTINGS ACCOUNTNO : GET
Route::get('settings/accountno/assign','SettingsController@accountno_assign');
Route::get('settings/accountno/generate','SettingsController@accountno_generate');
Route::get('settings/accountno/summary/{id?}', 'SettingsController@accountno_summary');
// SETTINGS ACCOUNTNO : POST
Route::post('settings/accountno/assign', 'SettingsController@accountno_assign_store');
Route::post('settings/accountno/generate', 'SettingsController@accountno_generate_store');
// API
Route::get('api/city/{prov_id?}', 'ApiController@getCityJson');
Route::get('api/province', 'ApiController@getProvinceJson');
Route::get('api/bargraph', 'ApiController@getDashboardBarGraph');
Route::get('api/reward/member/{level}/{id}', 'ApiController@getRewardMemberJson');
// GENEALOGY
Route::get('genealogy/{id}','GenealogyController@index');
// TRANSACTION
Route::get('transaction','TransactionController@index');