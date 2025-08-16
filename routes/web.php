<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/',[DashboardController::class, 'index'])
    ->name('dashboard');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::get('/load-more-products', [DashboardController::class, 'loadMoreProducts'])
    ->name('load-more-products');

    Route::get('/product/{id}', [ProductController::class, 'getProduct'])
    ->name('product');

    Route::get('/orders', [OrderController::class, 'getOrders'])
    ->name('get-orders');

    Route::get('/load-more-orders', [OrderController::class, 'loadMoreOrders'])
        ->name('load-more-orders');

    Route::post('/process-payment', [OrderController::class, 'processPayment'])
    ->name('processPayment');
    Route::get('/product/{id}', [ProductController::class, 'getProduct'])
    ->name('product');


});

require __DIR__ . '/auth.php';
