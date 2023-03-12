<?php

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



Route::controller(\App\Http\Controllers\General\SialsController::class)
    ->middleware(['auth', 'role:general'])
    ->prefix('/general/ziara')
    ->as('general.sial.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
    });



?>

