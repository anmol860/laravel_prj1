<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'show']);

Route::post('/add-tranaction', [DashboardController::class, 'addTransaction']);


