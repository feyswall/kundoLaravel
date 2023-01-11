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



Route::controller(DistrictsController::class)
    ->prefix('/super/areas/wilaya')
    ->as('super.areas.wilaya.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });
