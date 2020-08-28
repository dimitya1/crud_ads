<?php

use Illuminate\Support\Facades\Route;

Route::get('/', '\\' . \App\Http\Controllers\HomeController::class)
    ->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', '\\' . \App\Http\Controllers\AuthController::class . '@login')
        ->name('login');

    Route::post('/login', '\\' . \App\Http\Controllers\AuthController::class . '@check');
});


Route::middleware('auth')->group(function () {
    Route::get('/logout', '\\' . \App\Http\Controllers\AuthController::class . '@logout')
        ->name('logout');

    Route::middleware(\App\Http\Middleware\CheckAdAuthorUpdate::class)->group(function () {
        Route::get('/edit/{id?}', '\\' . \App\Http\Controllers\AdController::class . '@create')
            ->name('ad.create');

        Route::post('/edit/{id?}', '\\' . \App\Http\Controllers\AdController::class . '@save');
    });

    Route::middleware(\App\Http\Middleware\CheckAdAuthorDelete::class)->group(function () {
        Route::get('/delete/{id?}', '\\' . \App\Http\Controllers\AdController::class . '@delete')
            ->name('ad.delete');
    });
});


Route::get('/{id?}', '\\' . \App\Http\Controllers\ReadOneController::class)
    ->name('readone');

