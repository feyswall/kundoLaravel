
<?php



use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\MotorOwner\MotorServicesController::class)
    ->middleware(['auth', 'role:motorOwner'])
    ->prefix('/motorOwner/motor')
    ->as('motorOwner.motor.')
    ->group(function () {
        Route::get('/orodha', 'seeAllMotors')->name('.orodha');
    });


?>