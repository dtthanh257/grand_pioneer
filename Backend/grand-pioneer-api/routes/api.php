<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;

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

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout');
    Route::post('register', 'RegisterController@register');
});

Route::group(['namespace' => 'Api', 'middleware' => JwtMiddleware::class], function () {
    Route::group(['prefix' => 'me'], function () {
        Route::get('/', 'MeController@index');
    });

    Route::post('users/{id}/reset-password', 'UserController@resetPassword');
    Route::apiResource('users', 'UserController')->only(['index', 'show', 'update', 'destroy']);
});
