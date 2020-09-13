<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\User;
use App\Product;

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

Route::get('/', [HomeController::class, 'index']);
Route::name('products.')->prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::post('new', [ProductController::class, 'new']);
    Route::post('delete', [ProductController::class, 'delete']);
});
