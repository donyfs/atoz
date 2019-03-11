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

Route::get('/', ['uses'=>'login@index']);
Route::get('/login', [ 'as' => 'login', 'uses'=>'login@index']);
Route::get('/logout', [ 'as' => 'logout', 'uses'=>'logout@index']);
Route::post('/login_action', [ 'as' => 'login_action', 'uses'=>'login@loginPost']);

Route::get('/prepaid-balance', [ 'as' => 'balance', 'uses'=>'Balance@index']);
Route::post('/addBalance', [ 'as' => 'BalancePost', 'uses'=>'Balance@balancePost']);

Route::get('/register', [ 'as' => 'register', 'uses'=>'register@index']);
Route::post('/register_action', [ 'as' => 'register_action', 'uses'=>'register@registerPost']);

Route::get('/product', [ 'as' => 'product', 'uses'=>'Product@index']);
Route::post('/productPost', [ 'as' => 'productPost', 'uses'=>'Product@productPost']);

Route::get('/payment/{orderNo}', [ 'as' => 'getOrderNo', 'uses'=>'Payment@getOrderNo']);
Route::get('/payment', [ 'as' => 'payment', 'uses'=>'Payment@index']);
Route::post('/payOrder', [ 'as' => 'payOrder', 'uses'=>'Payment@payOrder']);

Route::get('/success', [ 'as' => 'success', 'uses'=>'Success@index']);
Route::get('/order', [ 'as' => 'order_history', 'uses'=>'Order@index']);
Route::post('/search_order', [ 'as' => 'search_order', 'uses'=>'Order@search']);

Route::get('/tes', ['uses'=>'TesController@tes_job']);

Route::get('/tes_balance', [ 'as' => 'tes_balance', 'uses'=>'TesController@tes_balance']);

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
