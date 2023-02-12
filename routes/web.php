<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmsServicesControlller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\AreasController;
use  App\Http\Controllers\Super\Area\DistrictsController;
use App\Models\Leader;
use App\Http\Controllers\Super\PostsController;
use App\Http\Controllers\PDFController;

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
        ->with('posts')->get();
    return view('dashboard')
    ->with("leaders", $leaders);
})->middleware(['auth', 'verified', 'role:super|mbunge'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/update-password', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(SmsServicesControlller::class)
    ->prefix('/sms')
    ->as('sms.')
    ->group(function () {
        Route::post('/send', 'send')->name('tuma');
        Route::post('/group/send', 'sendToGroup')->name('tuma.group');
        Route::get('/delivery', 'deriveryReport')->name('delivery');
        Route::get('/balance', 'checkBalance')->name('balance');
        Route::get('/orodha/sms', 'orodhaGroups')->name('orodha.group');
        Route::get('/orodha/group', 'selectReceivers')->name('group.select');
        Route::get('/orodha/show/{sms}', 'orodhaGroupMoja')->name('orodha.group.moja');
});

Route::post('generate-pdf', [PDFController::class, 'generatePDF'])->name("generatePDF");

  Route::post('/download/pdf', [PDFController::class,'downloadPdf'])->name('downloadPDF');

require __DIR__.'/auth.php';

require __DIR__.'/superRoute.php';

require __DIR__.'/mbungeRoute.php';
