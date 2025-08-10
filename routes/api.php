<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RateController;

Route::get('/rates', [RateController::class, 'index']);