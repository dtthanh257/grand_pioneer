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
    Route::apiResource('vessels/{vessel_id}/voyages', 'VoyageController')->only(['index', 'show']);

    Route::get('voyages/{voyage_id}/voyage-experience', 'VoyageExperienceController@index');

    Route::get('voyages/{voyage_id}/voyage-date-available', 'VoyageDateAvailableController@index');

    Route::get('voyages/{voyage_id}/voyage-metadata', 'VoyageMetadataController@index');

    Route::get('voyages/{voyage_id}/voyage-timeline', 'VoyageTimelineController@index');

    Route::get('voyages/{voyage_id}/voyage-locations', 'VoyageLocationController@index');

    Route::get('voyages/{voyage_id}/activities', 'ActivityController@getActivityByVoyage');

    Route::get('activities/{activity_id}/activity-metadata', 'ActivityMetadataController@index');

    Route::get('activities', 'ActivityController@index');

    Route::get('voyage-locations/{voyage_location_id}/voyage-location-metadata', 'VoyageLocationMetadataController@index');
});

Route::group(['namespace' => 'Api', 'middleware' => JwtMiddleware::class], function () {
    Route::apiResource('vessels/{vessel_id}/voyages', 'VoyageController')->only(['store', 'update', 'destroy']);

    Route::apiResource('voyages/{voyage_id}/voyage-experience', 'VoyageExperienceController')->only(['store', 'update', 'destroy']);

    Route::apiResource('voyages/{voyage_id}/voyage-date-available', 'VoyageDateAvailableController')->only(['store', 'update', 'destroy']);

    Route::apiResource('voyages/{voyage_id}/voyage-metadata', 'VoyageMetadataController')->only(['store', 'update', 'destroy']);

    Route::apiResource('voyages/{voyage_id}/voyage-timeline', 'VoyageTimelineController')->only(['store', 'update', 'destroy']);

    Route::apiResource('voyages/{voyage_id}/voyage-locations', 'VoyageLocationController')->only(['store', 'update', 'destroy']);

    Route::apiResource('voyages/{voyage_id}/activities', 'ActivityController')->only(['store', 'update', 'destroy']);

    Route::apiResource('activities/{activity_id}/activity-metadata', 'ActivityMetadataController')->only(['store', 'update', 'destroy']);

    Route::apiResource('voyage-locations/{voyage_location_id}/voyage-location-metadata', 'VoyageLocationMetadataController')->only(['store', 'update', 'destroy']);
});