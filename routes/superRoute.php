<?php
/**
 * Created by feyswal on 1/11/2023.
 * Time 1:43 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1/11/2023
 * Time: 1:43 PM
 */


use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Super\Area\DistrictsController;
use \App\Http\Controllers\Super\Area\CouncilsController;
use \App\Http\Controllers\Super\Area\DivisionsController;
use \App\Http\Controllers\Super\Area\WardsController;
use \App\Http\Controllers\Super\Area\BranchesController;
use \App\Http\Controllers\Super\Area\StatesController;

Route::controller(DistrictsController::class)
    ->prefix('/super/areas/district')
    ->as('super.areas.wilaya.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(CouncilsController::class)
    ->prefix('/super/areas/council')
    ->as('super.areas.halmashauri.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(DivisionsController::class)
    ->prefix('/super/areas/division')
    ->as('super.areas.tarafa.')
    ->group(function () {
        Route::get('/orodha/{council}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });




Route::controller(WardsController::class)
    ->prefix('/super/areas/ward')
    ->as('super.areas.kata.')
    ->group(function () {
        Route::get('/orodha/{division}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(BranchesController::class)
    ->prefix('/super/areas/branch')
    ->as('super.areas.tawi.')
    ->group(function () {
        Route::get('/orodha/{ward}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/fungua/{branch}', 'show')->name('fungua');
    });



Route::controller(StatesController::class)
    ->prefix('/super/areas/state')
    ->as('super.areas.jimbo.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });
