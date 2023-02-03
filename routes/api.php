<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\Area\DistrictsController;
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



Route::controller(\App\Http\Controllers\Super\Area\RegionsController::class)
    ->prefix('/super/areas/')
    ->as('super.areas.')
    ->group(function () {
        Route::get('/wilaya/orodha/{id}', 'getDistrictsApi')->name('wilaya.orodha');
//        Route::get('/halmashauri/orodha/{id}', 'getCouncilsApi')->name('halmashauri.orodha');
});



Route::controller(\App\Http\Controllers\Super\Area\DistrictsController::class)
    ->prefix('/super/areas/')
    ->as('super.areas.')
    ->group(function () {
//        Route::get('/wilaya/orodha/{id}', 'getDistrictsApi')->name('wilaya.orodha');
        Route::get('/halmashauri/orodha/{id}', 'getCouncilsApi')->name('halmashauri.orodha');
    });


Route::controller(\App\Http\Controllers\Super\Area\CouncilsController::class)
    ->prefix('/super/areas/')
    ->as('super.areas.')
    ->group(function () {
//        Route::get('/wilaya/orodha/{id}', 'getDistrictsApi')->name('wilaya.orodha');
        Route::get('/tarafa/orodha/{id}', 'getDivisionsApi')->name('tarafa.orodha');
    });


Route::controller(\App\Http\Controllers\Super\Area\DivisionsController::class)
    ->prefix('/super/areas/')
    ->as('super.areas.')
    ->group(function () {
//        Route::get('/wilaya/orodha/{id}', 'getDistrictsApi')->name('wilaya.orodha');
        Route::get('/kata/orodha/{id}', 'getWardsApi')->name('kata.orodha');
    });


Route::controller(\App\Http\Controllers\Super\Area\WardsController::class)
    ->prefix('/super/areas/')
    ->as('super.areas.')
    ->group(function () {
//        Route::get('/wilaya/orodha/{id}', 'getDistrictsApi')->name('wilaya.orodha');
        Route::get('/tawi/orodha/{id}', 'getbranchsApi')->name('tawi.orodha');
    });



