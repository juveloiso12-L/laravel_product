<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductController;

Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

use App\Http\Controllers\OrderController;

Route::get('/orders/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');