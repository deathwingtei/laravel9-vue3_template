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

    Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
    Route::get('/login', function () {
        return view('auth/login');
    });
    Route::get('/admin/article', ['middleware' => 'auth', function() {
        return view('article');
    }]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'index'], ['middleware' => 'auth', function() {
    }]);
    
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
    Route::get('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class,'showConfirmForm'])->name('password.confirm');
    Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');

    Route::get('/linkstorage', function () {
        Artisan::call('storage:link');
    });
    
    //POST Route
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class,'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
    Route::post('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class,'confirm']);
    Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class,'reset'])->name('password.update');

    //Put Route

    //Resource Route
    // Auth::routes();
