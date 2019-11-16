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
Route::post('add-to-cart','orderController@addToCart');
Route::patch('update-cart', 'orderController@update');
Route::delete('remove-from-cart', 'orderController@remove');
Route::post('checkout','orderController@saveOrder');
Auth::routes();
