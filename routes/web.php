<?php

use App\Events\GeneralSmsEvent;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmsServicesControlller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\AreasController;
use  App\Http\Controllers\Super\Area\DistrictsController;
use App\Models\Leader;
use App\Http\Controllers\Super\PostsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PdfDoorsController;
use Illuminate\Support\Facades\Hash;

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

Route::get('/account', function () {

    $gen = \Spatie\Permission\Models\Role::where('name', 'general')->first();

    if (!$gen) {
        $general = \Spatie\Permission\Models\Role::create([
            'name' => 'general',
        ]);
    }

    $leaders = Leader::select('firstName', 'lastName')->distinct('firstName', 'lastName')->get();
    $wanted = [];
    foreach ($leaders as $leader) {
        $wanted[] = Leader::where('firstName', $leader->firstName)
            ->where('lastName', $leader->lastName)
            ->first();
    }

    foreach ($wanted as $leader) {
        if ($leader->user == null) {

            $password = strtolower($leader->firstName) . "" . strtolower($leader->lastName);

            $email = strtolower($leader->firstName) . "" . strtolower($leader->lastName) . ".general@kims.com";

            $rules = [
                'email' => 'unique:users,email',
            ];

            $validate = \Illuminate\Support\Facades\Validator::make(['email' => $email], $rules);

            if ($validate->fails()) {
                continue;
            }

            $user = \App\Models\User::create([
                'name' => $leader->firstName . " " . $leader->lastName,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            $user->assignRole("general");
        }
    }
});


Route::get('/reverse_account', function () {
    $users = \App\Models\User::all();
    foreach ($users as $user) {
        $user->leader()->update([
            'user_id' => $user->id,
        ]);
    }
});

Route::get('/dashboard', function () {
    /** selecting all leaders from our database */
    $leaders = Leader::where("id", ">",  0)
        ->with('posts', function($query){
            $query->select('name');
        })->get();
        $leaders = $leaders->makeHidden(['created_at', 'updated_at', 'post.created_at']);
    return view('dashboard')
        ->with("leaders", $leaders);
})->middleware(['auth', 'verified', 'role:super|mbunge|general|motorOwner|assistance'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/update-password', [ProfileController::class, 'password'])->name('profile.password');
    Route::patch('/update-phone-number/{id}', [ProfileController::class, 'phone'])->name('profile.phone');
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

Route::controller(PdfDoorsController::class)
    ->prefix('/pdf/door')
    ->as('pdf.door.')
    ->middleware(['auth', 'role:super'])
    ->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    Route::get('/index', 'index')->name('index');
    });


Route::post('generate-pdf', [PDFController::class, 'generatePDF'])->name("generatePDF");

Route::post('newDownload', [PDFController::class, 'newDownload'])->name("newDownload");

Route::post('testPdf', [PDFController::class, 'testPdf'])->name("testPdf");

Route::post('/download/pdf', [PDFController::class, 'downloadPdf'])->name('downloadPDF');

// just for test route
Route::get('/smsMe', function(){
    $recevers = \App\Models\Receiver::all();
    foreach( $recevers as $receiver ){
        $customeToPass = ['id' => $receiver->id, 'phone' => $receiver->phone ];
        event(new GeneralSmsEvent(
            [$customeToPass],
            function($response){ info(json_encode($response)); },
            'hellow feyswall feeling great?',
            $receiver
        ));
    }
});

require __DIR__ . '/auth.php';

require __DIR__ . '/superRoute.php';

require __DIR__ . '/mbungeRoute.php';

require __DIR__ . "/general.php";

require  __DIR__. "/motorOwner.php";

require  __DIR__. "/assistance.php";
