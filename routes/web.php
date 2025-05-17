<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarServiceController;
use App\Http\Controllers\CarStoreController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::controller(CarServiceController::class)
    ->prefix('car-services')
    ->name('car-services.')
    ->group(function () {
        Route::get('/show', 'show')->name('show');
    });

Route::controller(CarStoreController::class)
    ->prefix('car-stores')
    ->name('car-stores.')
    ->group(function () {
        Route::get('/{carStore}', 'show')->name('show');
    });

Route::controller(BookingController::class)
    ->prefix('bookings')
    ->name('bookings.')
    ->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/save', 'save')->name('save');
        Route::get('/confirm', 'confirm')->name('confirm');
        Route::post('/store', 'store')->name('store');
    });
