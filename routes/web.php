<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Nurse\NurseController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallOutController;
use App\Http\Controllers\ForgotPasswordController;
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
    return redirect()->route('login');
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index')->name('main');
    });

    Route::controller(NurseController::class)->name('nurses.')->prefix('nurses')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/export', 'export')->name('export');
        Route::post('/import', 'import')->name('import');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{nurse_id}', 'destroy')->name('destroy');
    });

    Route::controller(SchoolController::class)->prefix('schools')->name('schools.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/export', 'export')->name('export');
        Route::post('/import', 'import')->name('import');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::controller(CallOutController::class)->name('call-out.')->group(function () {
        Route::get('/call-out', 'index')->name('index');
        Route::post('/call-out/confirm', 'confirm')->name('confirm');
        Route::post('/call-out/store', 'store')->name('store');
        Route::get('/call-out/school/{id}', 'school')->name('school');
        Route::get('/call-out/{id}', 'show')->name('show');
        Route::put('/call-out/{id}', 'update')->name('update');
        Route::delete('/call-out/{id}', 'destroy')->name('destroy');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('post-login', 'login')->name('post-login');
//    Route::post('register', 'registration')->name('registration')->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    Route::post('/logout', 'logout')->name('auth.logout');
});

Route::controller(ForgotPasswordController::class)->name('forgot-password.')->group(function () {
    Route::get('/forgot-password', 'index')->name('index');
    Route::post('/send-link', 'forgotPasswordRequest')->name('send-link');
    Route::get('/reset-password/{token}', 'resetPasswordView')->name('reset-password-view');
    Route::post('/reset-password', 'resetPassword')->name('reset-password');
});

Route::middleware(['auth', 'role:Full Time Float Nurse|Float Nurse'])
    ->controller(\App\Http\Controllers\FloatNurse\NurseController::class)
    ->prefix('nurse')
    ->name('float-nurse.')
    ->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::put('/profile', 'update')->name('update');

        Route::name('call-out.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/pick/{id}', 'pick')->name('pick');
            Route::post('/confirm', 'confirm')->name('confirm');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

Route::middleware(['auth', 'role:Perm School Nurse'])
    ->prefix('school-nurse')
    ->name('school-nurse.')
    ->group(function () {
        Route::controller(\App\Http\Controllers\SchoolNurse\NurseController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/profile', 'update')->name('update');
        });

        Route::controller(\App\Http\Controllers\SchoolNurse\CallOutController::class)->name('call-out.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/register/{schoolId?}', 'registerCallOut')->name('register');
            Route::post('/register/store', 'store')->name('store');
        });
    });
