<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirstSetupController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'CheckTestAccount'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::prefix('/products')->group(function () {
        Route::resource('/', ProductsController::class)
            ->parameters(['' => 'product'])
            ->names([
                'index' => 'products.index',
                'edit' => 'products.edit',
                'destroy' => 'products.destroy',
                'show' => 'products.show',
                'update' => 'products.update',
                'store' => 'products.store',
                'create' => 'products.create',
            ]);
    });

    Route::prefix('/users')->group(function () {
        Route::resource('/', UserController::class)
            ->parameters(['' => 'product'])
            ->names([
                'index' => 'users.index',
                'edit' => 'users.edit',
                'destroy' => 'users.destroy',
                'show' => 'users.show',
                'update' => 'users.update',
                'store' => 'users.store',
                'create' => 'users.create',
            ]);
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/first_setup', [FirstSetupController::class, 'index'])->name('first_setup');
    Route::post('/first_setup', [FirstSetupController::class, 'store'])->name('first_setup.store');
});
