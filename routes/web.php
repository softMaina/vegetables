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

Route::get('/', 'HomeController@index')->name('home');
Route::post('add-to-cart','OrderController@addToCart');
Route::delete('remove-from-cart', 'OrderController@remove');
Route::post('checkout','OrderController@checkout');
Route::get('executePayment','OrderController@executePayment');
Route::post('storeOrder','OrderController@storeOrder');

Route::get('seeOrders','OrderController@index');
Route::get('paypal','OrderController@paypal');

Auth::routes();
