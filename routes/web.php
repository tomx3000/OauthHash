<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
// views for the landing page created by lymo

Route::get('/product',['as'=>'product','uses'=>'DemoShopController@product']);
Route::get('/pricing',['as'=>'pricing','uses'=>'DemoShopController@pricing']);
Route::get('/demo',['as'=>'getdemo','uses'=>'DemoShopController@getdemo']);
Route::post('/demo',['as'=>'postdemo','uses'=>'DemoShopController@postdemo']);


//
Route::get('/sample',['as'=>'sample','uses'=>'CustomerApiController@sample']);
Route::post('/sample/testxml',['as'=>'testxml','uses'=>'CustomerApiController@xmlTestReceive']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/store/phone', 'HomeController@storePhone')->name('store.phone');
Route::get('/get/phones', 'HomeController@getPhones')->name('get.phones');
Route::delete('/delete/phone', 'HomeController@deletePhone')->name('delete.phone');
Route::get('/get/transactions', 'HomeController@getTransactions')->name('get.transactions');
// new routes
Route::post('/update/accountusage', 'HomeController@changeAccountUsage')->name('update.accountusage');
Route::get('/get/accountusage', 'HomeController@getAccountUsage')->name('get.accountusage');
Route::post('/update/custompriority', 'HomeController@updateCustomAccountPriority')->name('update.custompriority');
Route::get('/get/custompriority', 'HomeController@getCustomAccountPriority')->name('get.custompriority');
Route::post('/update/clientpriority', 'HomeController@updateClientAccountPriority')->name('update.clientpriority');
Route::get('/get/clientpriority', 'HomeController@getClientAccountPriority')->name('get.clientpriority');
Route::get('/get/credittransactions', 'HomeController@getUserCreditTransactions')->name('get.crdittransactions');
Route::get('/get/debittransactions', 'HomeController@getUserDebitTransactions')->name('get.debittransactions');
Route::get('/get/userclients', 'HomeController@getUserClients')->name('get.userclients');
Route::get('/get/usermobileaccounts', 'HomeController@getUserMobileAccounts')->name('get.usermobileaccounts');
Route::get('/get/userbankaccounts', 'HomeController@getUserBankAccounts')->name('get.userbankaccounts');
Route::get('/get/usercustomers', 'HomeController@getUserCustomers')->name('get.usercustomers');

Route::post('/get/usercredittransaction', 'HomeController@userCreditTransactionById')->name('update.usercredittransactionbyid');
Route::post('/update/transactionshowspan', 'HomeController@updateTransactionShowSpan')->name('update.transactionshowspan');
Route::get('/get/gettransactionsshowspan', 'HomeController@getTransactionsShowSpan')->name('get.gettransactionsshowspan');

Route::post('/update/phonenumber', 'HomeController@updatePhone')->name('update.phonenumber');
Route::get('/sendsms', 'HomeController@sendSMS')->name('sendsms');


// temporary user payment
Route::post('checkoutform_user_details',['as'=>'redirect.checkoutform_user_details','uses'=>'LoginController@redirectCheckoutformUserDetails']);

Route::post('checkoutform_verifyOTP',['as'=>'redirect.checkoutform_verifyOTP','uses'=>'LoginController@redirectCheckoutformVerifyOTP']);

Route::post('checkoutform_password',['as'=>'redirect.checkoutform_password','uses'=>'LoginController@redirectCheckoutformPassword']);

Route::get('checkout',['as'=>'view.checkout','uses'=>'LoginController@viewCheckout']);

Route::get('checkout_verifyOTP/{erid}',['as'=>'view.checkout_verifyOTP','uses'=>'LoginController@viewCheckoutVerifyOTP']);

Route::get('checkout_password',['as'=>'view.checkout_password','uses'=>'LoginController@viewCheckoutPassword']);


