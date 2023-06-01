<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Assistants\SialsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/ziara')
    ->as('assistants.sial.')
    ->group(function () {
        Route::get('/orodhesha', 'index')->name('allList')->middleware(['can:grob_sials']);
        Route::get('/ongeza', 'create')->name('create')->middleware(['can:grob_sials']);
        Route::get('/fungua/{sial}', 'show')->name('show')->middleware(['can:grob_sials']);;
        Route::post('/jaza', 'store')->name('jaza')->middleware(['can:grob_sials']);;
    });


?>
