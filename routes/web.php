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

    Route::middleware(['role:god|admin'])->group(function () {
        Route::get('/admin/article', function () { return view('article');  });
        Route::get('/admin/user', function () { return view('user');  });
        Route::get('/admin/websitesetting', function () { return view('websitesetting');  });


        //API From Local

        //Articles Set
        // List Articles
        Route::get('/local/articles', [App\Http\Controllers\ArticleController::class, 'index']);
        // single Article
        Route::get('/local/article/{id}', [App\Http\Controllers\ArticleController::class, 'show']);
        //create new article
        Route::post('/local/article', [App\Http\Controllers\ArticleController::class, 'store']);
        //update article
        Route::put('/local/article', [App\Http\Controllers\ArticleController::class, 'store']);
        //delete article
        Route::delete('/local/article/{id}', [App\Http\Controllers\ArticleController::class, 'destroy']);

        //WebsiteSetting Set
        // List Articles
        Route::get('/local/websitesettings', [App\Http\Controllers\WebsiteSettingController::class, 'index']);
        // List of page Articles
        Route::get('/local/websitesettings/page', [App\Http\Controllers\WebsiteSettingController::class, 'page']);
        // single Article
        Route::get('/local/websitesetting/{id}', [App\Http\Controllers\WebsiteSettingController::class, 'show']);
        //create new article
        Route::post('/local/websitesetting', [App\Http\Controllers\WebsiteSettingController::class, 'store']);
        //update article
        Route::put('/local/websitesetting', [App\Http\Controllers\WebsiteSettingController::class, 'store']);
        //delete article
        Route::delete('/local/websitesetting/{id}', [App\Http\Controllers\WebsiteSettingController::class, 'destroy']);

        //User Set
        // List User
        Route::get('/local/users_api', [App\Http\Controllers\UserController::class, 'list']);
        //single Users
        Route::get('/local/user_api/{id}', [App\Http\Controllers\UserController::class, 'show']);
        //create new User
        Route::post('/local/user_api', [App\Http\Controllers\UserController::class, 'store']);
        //update User
        Route::put('/local/user_api', [App\Http\Controllers\UserController::class, 'store']);
        //delete User
        Route::delete('/local/user_api/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
        //api login
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/current_permission', [App\Http\Controllers\UserController::class, 'permission'], function() { });
    });

    //Get route
    Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
    Route::get('/login', function () { return view('auth/login');  });
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
    Route::get('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class,'showConfirmForm'])->name('password.confirm');
    Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::get('/linkstorage', function () { Artisan::call('storage:link'); });

    //POST Route
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class,'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
    Route::post('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class,'confirm']);
    Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class,'reset'])->name('password.update');

    //Put Route

    //Resource Route
    // Auth::routes();
