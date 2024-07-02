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
    Route::apiResource('vessels/{vessel_id}/services', 'ServiceController')->only(['index', 'show']);

    Route::get('services/{service_id}/service-metadata', 'ServiceMetadataController@index');
});

Route::group(['namespace' => 'Api', 'middleware' => JwtMiddleware::class], function () {
    Route::apiResource('vessels/{vessel_id}/services', 'ServiceController')->only(['store', 'update', 'destroy']);

    Route::apiResource('services/{service_id}/service-metadata', 'ServiceMetadataController')->only(['store', 'update', 'destroy']);
});