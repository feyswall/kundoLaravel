<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\General\SialsController::class)
    ->middleware(['auth', 'role:general'])
    ->prefix('/general/ziara')
    ->as('general.sial.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
        Route::get('/fungua/barua/{sial}', 'show')->name('show');
    });



?>

