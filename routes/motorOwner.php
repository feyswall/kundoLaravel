
<?php



use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\MotorOwner\MotorServicesController::class)
    ->middleware(['auth', 'role:motorOwner'])
    ->prefix('/motorOwner/motor')
    ->as('motorOwner.motor')
    ->group(function () {
        Route::get('/orodha', 'seeAllMotors')->name('.orodha');
        Route::get('/fanyia/service/{motor}', 'createService')->name('.create');
    });

Route::controller(\App\Http\Controllers\MotorOwner\MotorServicesController::class)
    ->middleware(['auth', 'role:motorOwner'])
    ->prefix('/motorOwner/service')
    ->as('motorOwner.service')
    ->group(function () {
        Route::get('/orodha', 'seeAllService')->name('.orodha');
        Route::post('/ongeza', 'ongezaService')->name('.ongeza');
        Route::get('/moja/{id}', 'serviceMoja')->name('.moja');
    });

Route::controller(\App\Http\Controllers\MotorServiceTypesController::class)
    ->middleware(['auth', 'role:motorOwner'])
    ->prefix('/motorOwner/service/type')
    ->as('motorOwner.service.type')
    ->group(function () {
        Route::get('/orodha', 'seeAllServiceTypes')->name('.orodha');
        Route::post('/ongeza', 'ongezaServiceType')->name('.ongeza');
    });

Route::controller(\App\Http\Controllers\GaragesController::class)
    ->middleware(['auth', 'role:motorOwner'])
    ->prefix('/motorOwner/garage')
    ->as('motorOwner.garage')
    ->group(function () {
        Route::get('/orodha', 'seeAllGarages')->name('.orodha');
        Route::post('/ongeza', 'ongezaGarage')->name('.ongeza');
    });

Route::controller(\App\Http\Controllers\MotorOwner\RegionsController::class)
    ->middleware(['auth', 'role:motorOwner'])
    ->prefix('/motorOwner/region')
    ->as('motorOwner.region')
    ->group(function () {
        Route::post('/ongeza', 'ongezaMkoa')->name('.ongeza');
    });


?>
