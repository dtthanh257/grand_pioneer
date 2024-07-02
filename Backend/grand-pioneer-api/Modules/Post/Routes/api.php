<?php

use App\Http\Middleware\JwtMiddleware;
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

Route::group(['namespace' => 'Api'], function() {
    Route::get('/posts/{post_id}', 'PostController@show');
    Route::get('/posts', 'PostController@index');

    Route::get('posts/{post_id}/post-section', 'PostSectionController@index');
});

Route::group(['namespace' => 'Api', 'middleware' => JwtMiddleware::class], function () {
    Route::apiResource('/posts', 'PostController')->only(['store', 'update', 'destroy']);

    Route::apiResource('posts/{post_id}/post-section', 'PostSectionController')->only(['store', 'update', 'destroy']);
});