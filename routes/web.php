<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Auth::routes();

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])
    ->name('index');

Route::post('/product', [\App\Http\Controllers\MainController::class, 'product'])
    ->name('index.product');

Route::get('/home', [HomeController::class, 'home'])
    ->name('home');

Route::get('/order', [OrderController::class, 'index'])
    ->name('order.index');

Route::post('/order', [OrderController::class, 'create'])
    ->name('order.create');

Route::delete('/order/delete', [OrderController::class, 'delete'])
    ->name('order.delete');
