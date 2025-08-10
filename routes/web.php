<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RateController;

Route::get('/', function () {
    return view('app');
});

// *** Code for Additional Request: Add new rate upon form submission ***
Route::get('/', [\App\Http\Controllers\MainController::class, 'index']);
Route::post('/add-new-rate', [RateController::class, 'store'])->name('rates.store');