<?php

use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\OtpController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->name('mobile.')->group(function () {
    Route::get('/mobile/login', 'login')->name('login');
});

Route::controller(OtpController::class)->prefix('/otp')->name('otp.')->group(function () {
    Route::post('generate', 'generate')->name('generate');
    Route::get('/{user_id}', 'verify')->name('verify');
    Route::post('/login', 'login')->name('login');
});
