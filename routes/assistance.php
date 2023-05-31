<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Assistance\SialsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistance/ziara')
    ->as('assistance.sial.')
    ->group(function () {
        Route::get('/orodhesha', 'index')->name('allList');
        Route::get('/ongeza', 'create')->name('create');
        Route::get('/fungua/{sial}', 'show')->name('show');
        Route::post('/jaza', 'store')->name('jaza');
    });



?>
