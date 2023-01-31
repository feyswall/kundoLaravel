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
use App\Http\Controllers\Super\Group\GroupsController;
use \App\Http\Controllers\Super\Leader\BranchLeadersController;
use App\Http\Controllers\Super\Leader\DivisionLeadersController;
use App\Http\Controllers\Super\Leader\WardLeadersController;
use App\Http\Controllers\Super\Leader\CouncilLeadersController;
use App\Http\Controllers\Super\Leader\DistrictLeadersController;
use App\Http\Controllers\Super\Leader\RegionLeadersController;
use App\Http\Controllers\Super\Leader\StateLeadersController;
use App\Http\Controllers\Super\Posts\PostsController;


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


Route::controller(\App\Http\Controllers\Super\Area\StatesController::class)
    ->prefix('/super/areas/state')
    ->as('super.areas.jimbo.')
    ->group(function () {
        Route::get('/fungua/{state}', 'show')->name('fungua');
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(BranchLeadersController::class)
->prefix('/super/leader/branch')
->as('super.leader.tawi.')
->group(function () {
    Route::get('/orodha/{ward}', 'index')->name('orodha');
    Route::post('/ongeza', 'store')->name('ongeza');
    Route::put('/badili/{leader}', 'update')->name('sasisha');
});


Route::controller(WardLeadersController::class)
    ->prefix('/super/leader/ward')
    ->as('super.leader.kata.')
    ->group(function () {
        Route::get('/orodha/{division}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/badili/{leader}', 'update')->name('sasisha');
    });


Route::controller(DivisionLeadersController::class)
->prefix('/super/leader/division')
->as('super.leader.tarafa.')
->group(function () {
    Route::get('/orodha/{council}', 'index')->name('orodha');
    Route::post('/ongeza', 'store')->name('ongeza');
    Route::get('/badili/{leader}', 'edit')->name('badili');

});


Route::controller(CouncilLeadersController::class)
    ->prefix('/super/leader/council')
    ->as('super.leader.halmashauri.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(DistrictLeadersController::class)
    ->prefix('/super/leader/district')
    ->as('super.leader.wilaya.')
    ->group(function () {
        Route::get('/orodha/{region}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/sasisha/{leader}', 'update')->name('sasisha');

    });


Route::controller(RegionLeadersController::class)
    ->prefix('/super/leader/region')
    ->as('super.leader.mkoa.')
    ->group(function () {
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/sasisha/{leader}', 'update')->name('sasisha');
    });


Route::controller(StateLeadersController::class)
    ->prefix('/super/leader/state')
    ->as('super.leader.jimbo.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(GroupsController::class)
    ->prefix('/super/group')
    ->as('super.group.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
        Route::post('/toaWadhifa', 'removePost')->name('toaWadhifa');
        Route::post('/ongezaWadhifa', 'addPost')->name('ongezaWadhifa');
        Route::put('/rekebishaWadhifa/{group}', 'editGroup')->name('editWadhifa');
        Route::post('/sajiriWadhifa', 'storeWadhifa')->name('storeWadhifa');
        Route::put('/onaGroup/{group}', 'showSingleGroup')->name('showGroup');
});


Route::controller(PostsController::class)
    ->prefix('/super/wadhifa')
    ->as('super.posts.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
        Route::post('/ongezaWadhifa', 'store')->name('ongeza');
        Route::put('/badiriWadhifa/{post}', 'update')->name('updateWadhifa');
    });
