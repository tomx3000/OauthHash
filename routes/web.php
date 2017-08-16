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
Route::get('/sample',['as'=>'sample','uses'=>'CustomerApiController@sample']);
Route::post('/sample/testxml',['as'=>'testxml','uses'=>'CustomerApiController@xmlTestReceive']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/store/phone', 'HomeController@storePhone')->name('store.phone');
Route::get('/get/phones', 'HomeController@getPhones')->name('get.phones');
Route::delete('/delete/phone', 'HomeController@deletePhone')->name('delete.phone');
Route::get('/get/transactions', 'HomeController@getTransactions')->name('get.transactions');

