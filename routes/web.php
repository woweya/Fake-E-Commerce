<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\ApiController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\ApiController::class, 'showAll'])->name('products');

Route::get('/products/{id}', [App\Http\Controllers\ApiController::class, 'showOne'])->name('product');
