<?php

use App\Http\Controllers\Assistants\Apartment\ApartmentsController;
use App\Http\Controllers\Assistants\House\HousesController;
use App\Http\Controllers\Assistants\House\HouseTypesController;
use App\Http\Controllers\Assistants\Payments\PaymentsController;
use App\Http\Controllers\Assistants\TenantsController;
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



Route::controller(HousesController::class)
->middleware(['auth', 'role:assistance'])
->prefix('/assistants/houses')
->as('assistants.houses.')
->group(function () {
    Route::get('/houses/show/{id}', 'show')->name('showHouse');
    Route::get('/all/houses', 'index')->name('allHouses');
    Route::post('/houses/create', 'store')->name('storeHouse');
});

Route::controller(ApartmentsController::class)
->middleware(['auth', 'role:assistance'])
->prefix('/assistants/apartment')
->as('assistants.apartment.')
->group(function () {
    Route::get('/show/{id}', 'show')->name('showApartment');
    Route::post('/store', 'store')->name('storeApartment');
    Route::get('/unpaid', 'unpaid')->name('unpaid');
});

Route::controller(HouseTypesController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/houseTypes')
    ->as('assistants.houseTypes.')
    ->group(function () {
        Route::get('/', 'showAll')->name('showAll');
        Route::post('/store', 'storeHouseType')->name('storeHouseType');
    });

Route::controller(PaymentsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/payment')
    ->as('assistants.payments.')
    ->group(function () {
        Route::post('/store', 'store')->name('storePayment');
        Route::post('/store/for/shop', 'storeForShop')->name('storeShopPayment');
    });

Route::controller(TenantsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/tenants')
    ->as('assistants.tenants.')
    ->group(function () {
        Route::post('/assign', 'assignTenant')->name('assignTenant');
        Route::post('/store', 'storeTenant')->name('storeTenant');
        Route::post('/storeForShop', 'storeTenantForShop')->name('storeTenantForShop');
        Route::delete('/delete/{id}', 'deleteTenant')->name('deleteTenant');
    });

?>
