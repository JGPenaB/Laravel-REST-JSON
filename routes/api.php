<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
JsonApi::register('v1')->routes(function ($api) {
	
	$api->resource('users',[
		'has-one'=>'profiles',
		'has-many'=>'accounts'
	]);
	$api->resource('profiles',[
		'has-one'=>'users'
	]);
	$api->resource('accounts',[
		'has-one'=>'users',
		'has-many'=>'transactions'
	]);
	$api->resource('transactions',[
		'has-one'=>'accounts'
	])->except('update','delete');
	
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
