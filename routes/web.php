<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/items', 'ItemController@index')->name('items');
    Route::get('/items/create', 'ItemController@create')->name('items.create');
    Route::get('/items/{id}', 'ItemController@edit')->name('items.edit');
    Route::put('/items/{id}', 'ItemController@update')->name('items.update');
    Route::put('/items/update/status/{id}', 'ItemController@updateStatus')->name('items.update.status');
    Route::post('/items', 'ItemController@store')->name('items.store');

    Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/orders/create', 'OrderController@create')->name('orders.create');
    Route::get('/orders/{id}', 'OrderController@edit')->name('orders.edit');
    Route::put('/orders/{id}', 'OrderController@update')->name('orders.update');
    Route::put('/orders/update/status/{id}', 'OrderController@updateStatus')->name('orders.update.status');
    Route::post('/orders', 'OrderController@store')->name('orders.store');
});
