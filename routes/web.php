<?php

use App\Livewire\Cart;
use App\Livewire\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\ApiController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\ApiController::class, 'showAll'])->name('products');

Route::get('/product/{id}', [App\Http\Controllers\ApiController::class, 'showOne'])->name('product');

Route::get('/cart', [Cart::class, 'viewCart'])->name('cart.view');
