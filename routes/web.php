<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', '\\' . \App\Http\Controllers\AuthController::class . '@login')
    ->name('login')
    ->middleware('guest');

Route::post('/login', '\\' . \App\Http\Controllers\AuthController::class . '@check')
    ->middleware('guest');

Route::get('/logout', '\\' . \App\Http\Controllers\AuthController::class . '@logout')
    ->name('logout')
    ->middleware('auth');
