<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    //article set
    // List Articles
    Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index']);
    // single Article
    Route::get('/article/{id}', [App\Http\Controllers\ArticleController::class, 'show']);
    //create new article
    Route::post('/article', [App\Http\Controllers\ArticleController::class, 'store']);
    //update article
    Route::put('/article', [App\Http\Controllers\ArticleController::class, 'store']);
    //delete article
    Route::delete('/article/{id}', [App\Http\Controllers\ArticleController::class, 'destroy']);
    //WebsiteSetting Set
    // List Articles
    Route::get('/websitesettings', [App\Http\Controllers\WebsiteSettingController::class, 'index']);
    // single Article
    Route::get('/websitesetting/{id}', [App\Http\Controllers\WebsiteSettingController::class, 'show']);
    //create new article
    Route::post('/websitesetting', [App\Http\Controllers\WebsiteSettingController::class, 'store']);
    //update article
    Route::put('/websitesetting', [App\Http\Controllers\WebsiteSettingController::class, 'store']);
    //delete article
    Route::delete('/websitesetting/{id}', [App\Http\Controllers\WebsiteSettingController::class, 'destroy']);
    //user set
    // List User
    Route::get('/users_api', [App\Http\Controllers\UserController::class, 'list']);
    //single Users
    Route::get('/user_api/{id}', [App\Http\Controllers\UserController::class, 'show']);
    //create new User
    Route::post('/user_api', [App\Http\Controllers\UserController::class, 'store']);
    //update User
    Route::put('/user_api', [App\Http\Controllers\UserController::class, 'store']);
    //delete User
    Route::delete('/user_api/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
    //api login
    
});

//https://dev.to/shanisingh03/laravel-api-authentication-using-laravel-sanctum-edg
Route::post('/auth/login', [App\Http\Controllers\Api\AuthController::class, 'loginUser']);

//sendmail
Route::post('/send-email', [App\Http\Controllers\SendEmailController::class, 'index']);