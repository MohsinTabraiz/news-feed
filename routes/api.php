<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserPreferencesController;
use Illuminate\Support\Facades\Route;

Route::get('not-logged-in-error', [LoginController::class, 'notLoggedInError'])->name('not-logged-in-error');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('get-all-data', [DataController::class, 'get'])->name('get-all-data');

    Route::get('get-preferences', [UserPreferencesController::class, 'get'])->name('get-preferences');
    Route::put('update-preferences', [UserPreferencesController::class, 'update'])->name('update-preferences');
});
