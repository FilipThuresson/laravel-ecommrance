<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirstSetupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'CheckTestAccount'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/first_setup', [FirstSetupController::class, 'index'])->name('first_setup');
    Route::post('/first_setup', [FirstSetupController::class, 'store'])->name('first_setup.store');
});
