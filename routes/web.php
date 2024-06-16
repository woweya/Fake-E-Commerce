<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\ApiController::class, 'index'])->name('home');
