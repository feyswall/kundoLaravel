<?php


use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\Mbunge\ChallengesController::class)
    ->middleware(['auth', 'role:mbunge'])
    ->prefix('/mbunge/challenges')
    ->as('mbunge.challenges')
    ->group(function () {
        Route::get('/orodha/{kazi}', 'index')->name('.orodha');
        Route::get('/hifadhi/{from}', 'submitChallenge')->name('.wasirisha');
        Route::get('/show/{challenge}', 'show')->name('.fungua');
        Route::post('/jaza', 'store')->name('.jaza');
        Route::get('/baridi/tuma/{challenge}', 'showExist')->name('.show.exist');
        Route::put('/tuma/{challenge}', 'preExistToExist')->name('.toExist');
    });


?>
