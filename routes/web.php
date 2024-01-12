<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes(['register' => false,
'reset' => false, // Password Reset Routes...
'verify' => false // Email Verification Routes...
]);

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/template_email', [HomeController::class, 'templateOrderMailTest']);
    Route::get('/contact_email', [HomeController::class, 'orderMailTest']);
    Route::get('/api_users', [ApiUserController::class, 'index'])->name('api_users');
    Route::get('/items', [ItemController::class, 'index'])->name('items');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::get('/items/{id}', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::put('/items/update/status/{id}', [ItemController::class, 'updateStatus'])->name('items.update.status');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/{id}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::put('/orders/update/status/{id}', [OrderController::class, 'updateStatus'])->name('orders.update.status');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

