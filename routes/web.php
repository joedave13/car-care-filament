<?php

use App\Http\Controllers\CarServiceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::controller(CarServiceController::class)
    ->prefix('car-services')
    ->name('car-services.')
    ->group(function () {
        Route::get('/show', 'show')->name('show');
    });
