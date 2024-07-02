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
    Route::get('suites/{suite_id}/suite-metadata', 'SuiteMetadataController@index');
});

Route::group(['namespace' => 'Api', 'middleware' => JwtMiddleware::class], function () {
    Route::apiResource('suites/{suite_id}/suite-metadata', 'SuiteMetadataController')->only(['store', 'update', 'destroy']);
});