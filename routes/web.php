<?php

use App\Http\Controllers\ProductController;
use App\Providers\RouteServiceProvider;
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

Route::redirect('/', RouteServiceProvider::HOME);

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/navigate', [ProductController::class, 'navigate'])->name('navigate');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/create', [ProductController::class, 'store'])->name('store');
});
