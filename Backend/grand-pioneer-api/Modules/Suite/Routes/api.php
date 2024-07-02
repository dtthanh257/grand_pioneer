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
    Route::get('vessels/{vessel_id}/suites', 'SuiteController@getSuiteByVessel');
    Route::get('suites', 'SuiteController@index');
    Route::get('vessels/{vessel_id}/suites/{suite_id}', 'SuiteController@show');
});

Route::group(['namespace' => 'Api', 'middleware' => JwtMiddleware::class], function () {
    Route::apiResource('vessels/{vessel_id}/suites', 'SuiteController')->only(['store', 'update', 'destroy']);

    Route::apiResource('suite-type', 'SuiteTypeController')->only(['destroy', 'store', 'index']);
});