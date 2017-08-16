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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("test",function(){
	return response()->json(["name"=>"jackson","age"=>"9"]);
});

Route::post('customer/pay',['as'=>'customer.pay','uses'=>'CustomerApiController@customerPay'])->middleware('auth_client');

// this interface to be put on the zatana site for clients to register for free and will be email passwords or tokens

Route::post('client/register',['as'=>'client.register','uses'=>'ClientApiController@clientRegister']);