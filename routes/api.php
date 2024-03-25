<?php

use App\Http\Controllers\GaragesController;
use App\Http\Controllers\SmsServicesControlller;
use App\Http\Controllers\Super\LeadersController;
use App\Http\Controllers\Super\PostsController;
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

Route::controller(\App\Http\Controllers\Super\Area\BranchesController::class)
    ->prefix('/super/areas/')
    ->as('super.areas.')
    ->group(function () {
//        Route::get('/wilaya/orodha/{id}', 'getDistrictsApi')->name('wilaya.orodha');
        Route::get('/tawi/badirishwa/{id}', 'changedbranchsApi')->name('tawi.badirishwa');
    });



Route::controller(SmsServicesControlller::class)
->prefix('/super/sms/')
->as('super.sms.')
->group(function () {
    Route::get('group/orodha/{id}', 'orodhaGroupMojaApi')->name('group.orodha');
    Route::get('status/{phone}/{request_id}', 'smsStatusApi')->name('group.orodha');
});

Route::controller(\App\Http\Controllers\Super\MotorTypesController::class)
->prefix('/super/motor/type/')
->as('super.motor.type.')
->group(function () {
    Route::get('getModels/{id}', 'getModels')->name('get.models');
});


Route::controller(\App\Http\Controllers\Super\MotorCategoriesController::class)
    ->prefix('/super/motor/category/')
    ->as('super.motor.category.')
    ->group(function () {
        Route::get('getTypes/{id}', 'getTypes')->name('get.types');
    });


Route::controller(\App\Http\Controllers\Super\MotorsController::class)
    ->prefix('/super/vyombo/vya/moto')
    ->as('super.motor.')
    ->group(function () {
        Route::POST('/sajiri', 'store')->name('store');
    });


Route::controller(GaragesController::class)
    ->prefix('/garage')
    ->as('garage')
    ->group(function () {
        Route::get('/orodha/{id}', 'garageChangedApi')->name('.orodha');
    });


Route::controller(PostsController::class)
    ->prefix('/area')
    ->as('area.')
    ->group(function () {
        Route::post('/posts/search', 'areaChangeApi')->name('posts.orodha');
        Route::post('/locations/search', 'areaLocationsApi')->name('locations.orodha');
    });


Route::controller(LeadersController::class)
->prefix('/area')
->as('area.')
->group(function () {
    Route::post('/leaders/search', 'leaderChangeApi')->name('leaders.orodha');
    Route::post('/all/leaders/search', 'allLeadersApi')->name('all.leaders.orodha');
    Route::post('/leaders/sial/based/search', 'postChangeApi')->name('leaders.sial.based.orodha');
    Route::post('/leaders');
});

Route::controller(LeadersController::class)
    ->group(function() {
        Route::post("/leaders/search/in/dashboard", 'dashboardSearch')->name('dashboard.search');
    });