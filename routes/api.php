<?php

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

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


Route::get('loading',['as'=>'redirect.loading','uses'=>'ClientRedirectPaymentCotroller@redirectLoading']);
Route::post('checkoutform',['as'=>'redirect.checkoutform','uses'=>'ClientRedirectPaymentCotroller@redirectCheckoutform'])->middleware('auth_client');


//onetime url handling routes

Route::get('oneurl/{pass}/{cryptid}',['as'=>'onetime.url','uses'=>'ClientRedirectPaymentCotroller@oneTimeUrlAuth'])->middleware('web');

Route::get('testpath',['as'=>'onetime.testurl','uses'=>'ClientRedirectPaymentCotroller@testPath']);


//encryption testing route
Route::get('cipher',['as'=>'onetime.cipher','uses'=>'ClientRedirectPaymentCotroller@testCipher']);


