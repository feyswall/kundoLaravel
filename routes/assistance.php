<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Assistants\SialsController::class)
    ->middleware(['auth', 'role:assistants'])
    ->prefix('/assistants/ziara')
    ->as('assistants.sial.')
    ->group(function () {
        Route::get('/orodhesha', 'index')->name('allList')->middleware(['can:index_assistance','grob_assistance']);
        Route::get('/ongeza', 'create')->name('create')->middleware(['can:create_assistance','grob_assistance']);
        Route::get('/fungua/{sial}', 'show')->name('show')->middleware(['can:show_assistance','grob_assistance']);;
        Route::post('/jaza', 'store')->name('jaza')->middleware(['can:store_assistance','grob_assistance']);;
    });


?>
