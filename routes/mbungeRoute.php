<?php


use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\Mbunge\ChallengesController::class)
    ->prefix('/mbunge/challenges')
    ->as('mbunge.challenges')
    ->group(function () {
        Route::get('/orodha/{kazi}', 'index')->name('.orodha');
        Route::get('/hifadhi', 'submitChallenge')->name('.wasirisha');
        Route::get('/show/{challenge}', 'show')->name('.fungua');
    
        Route::post('/jaza', 'store')->name('.jaza');
    });


?>