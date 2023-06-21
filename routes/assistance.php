<?php

use App\Http\Controllers\Assistants\Apartment\ApartmentsController;
use App\Http\Controllers\Assistants\Area\BranchesController;
use App\Http\Controllers\Assistants\Area\CouncilsController;
use App\Http\Controllers\Assistants\Area\DistrictsController;
use App\Http\Controllers\Assistants\Area\DivisionsController;
use App\Http\Controllers\Assistants\Area\GeneralAreasController;
use App\Http\Controllers\Assistants\Area\StatesController;
use App\Http\Controllers\Assistants\Area\TrunksController;
use App\Http\Controllers\Assistants\Area\WardsController;
use App\Http\Controllers\Assistants\Group\GroupsController;
use App\Http\Controllers\Assistants\House\HousesController;
use App\Http\Controllers\Assistants\House\HouseTypesController;
use App\Http\Controllers\Assistants\Leader\BranchLeadersController;
use App\Http\Controllers\Assistants\Leader\CouncilLeadersController;
use App\Http\Controllers\Assistants\Leader\DistrictLeadersController;
use App\Http\Controllers\Assistants\Leader\DivisionLeadersController;
use App\Http\Controllers\Assistants\Leader\RegionLeadersController;
use App\Http\Controllers\Assistants\Leader\StateLeadersController;
use App\Http\Controllers\Assistants\Leader\TrunkLeadersController;
use App\Http\Controllers\Assistants\Leader\WardLeadersController;
use App\Http\Controllers\Assistants\LeadersController;
use App\Http\Controllers\Assistants\Payments\PaymentsController;
use App\Http\Controllers\Assistants\PostsController;
use App\Http\Controllers\Assistants\SialsController;
use App\Http\Controllers\Assistants\TenantsController;
use Illuminate\Support\Facades\Route;



Route::controller(GeneralAreasController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/general')
    ->as('assistants.areas.general')
    ->group(function () {
        Route::get('/anzaKutafuta', 'searchIndex')->name('.anza');
    });



Route::controller(DistrictsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/district')
    ->as('assistants.areas.wilaya.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(CouncilsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/council')
    ->as('assistants.areas.halmashauri.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(DivisionsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/division')
    ->as('assistants.areas.tarafa.')
    ->group(function () {
        Route::get('/orodha/{council}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(WardsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/ward')
    ->as('assistants.areas.kata.')
    ->group(function () {
        Route::get('/orodha/{division}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(BranchesController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/branch')
    ->as('assistants.areas.tawi.')
    ->group(function () {
        Route::get('/orodha/{ward}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/fungua/{branch}', 'show')->name('fungua');
    });


Route::controller(TrunksController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/trunk')
    ->as('assistants.areas.shina.')
    ->group(function () {
        Route::get('/orodha/{branch}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/fungua/{trunk}', 'show')->name('fungua');
        Route::get('/badiri/{trunk}', 'update')->name('sahihisha');
    });



Route::controller(StatesController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/areas/state')
    ->as('assistants.areas.jimbo.')
    ->group(function () {
        Route::get('/fungua/{state}', 'show')->name('fungua');
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(BranchLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/branch')
    ->as('assistants.leader.tawi.')
    ->group(function () {
        Route::get('/orodha/{ward}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::put('/badili/{leader}', 'update')->name('sasisha');
    });

Route::controller( TrunkLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/trunk')
    ->as('assistants.leader.shina.')
    ->group(function () {
        Route::get('/orodha/{branch}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::put('/badili/{trunk}', 'update')->name('sasisha');
    });


Route::controller(WardLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/ward')
    ->as('assistants.leader.kata.')
    ->group(function () {
        Route::get('/orodha/{division}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/badili/{leader}', 'update')->name('sasisha');
    });


Route::controller(DivisionLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/division')
    ->as('assistants.leader.tarafa.')
    ->group(function () {
        Route::get('/orodha/{council}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');

    });


Route::controller(CouncilLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/council')
    ->as('assistants.leader.halmashauri.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(DistrictLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/district')
    ->as('assistants.leader.wilaya.')
    ->group(function () {
        Route::get('/orodha/{region}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/sasisha/{leader}', 'update')->name('sasisha');

    });


Route::controller(RegionLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/region')
    ->as('assistants.leader.mkoa.')
    ->group(function () {
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/sasisha/{leader}', 'update')->name('sasisha');
    });


Route::controller(StateLeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader/state')
    ->as('assistants.leader.jimbo.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(GroupsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/group')
    ->as('assistants.group.')
    ->group(function () {
        Route::get('/orodha/{side}', 'index')->name('orodha');
        Route::post('/toaWadhifa', 'removePost')->name('toaWadhifa');
        Route::post('/ongezaWadhifa', 'addPost')->name('ongezaWadhifa');
        Route::put('/rekebishaWadhifa/{group}', 'editGroup')->name('editWadhifa');
        Route::post('/sajiriWadhifa', 'storeWadhifa')->name('storeWadhifa');
        Route::put('/onaGroup/{group}', 'showSingleGroup')->name('showGroup');
    });


Route::controller(PostsController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/wadhifa')
    ->as('assistants.posts.')
    ->group(function () {
        Route::get('/orodha/{side}', 'index')->name('orodha');
        Route::post('/ongezaWadhifa', 'store')->name('ongeza');
        Route::put('/badiriWadhifa/{post}', 'update')->name('updateWadhifa');
    });




Route::controller(SialsController::class)
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

Route::controller(LeadersController::class)
    ->middleware(['auth', 'role:assistance'])
    ->prefix('/assistants/leader')
    ->as('assistants.leader.')
    ->group(function () {
        Route::put('/remove/from/power', 'removeFromPower')->name('unpower');
        Route::get('/ona/kiongozi/{id}', 'viewLeader')->name('fungua');
        Route::get('/tafuta/kiongozi/kwa/eneo', 'searchLeaders')->name('searchLeader');
    });


?>
