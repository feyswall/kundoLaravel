<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmsServicesControlller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\AreasController;
use  App\Http\Controllers\Super\Area\DistrictsController;
use App\Models\Leader;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    /** selecting all leaders from our database */
    $leaders = Leader::where("id", ">",  0)
        ->with('posts', function($query) {
        $query->select("name", "deep");
    })->get();
    return view('dashboard')
    ->with("leaders", $leaders);
})->middleware(['auth', 'verified', 'role:super|mbunge'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(SmsServicesControlller::class)
    ->prefix('/sms')
    ->as('sms.')
    ->group(function () {
        Route::post('/send', 'send')->name('tuma');
    });

require __DIR__.'/auth.php';

require __DIR__.'/superRoute.php';
