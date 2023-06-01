<?php
/**
 * Created by feyswal on 1/11/2023.
 * Time 1:43 PM.
 * EastCoders & G3NET.
 * contacts: +255 628 960 877
 */

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1/11/2023
 * Time: 1:43 PM
 */


use App\Http\Controllers\Super\Apartment\ApartmentsController;
use App\Http\Controllers\Super\CharitiesController;
use App\Http\Controllers\Super\House\HousesController;
use App\Http\Controllers\Super\HouseTypesController;
use App\Http\Controllers\Super\ReceiversController;
use App\Http\Controllers\Super\TenantsController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Super\Area\DistrictsController;
use \App\Http\Controllers\Super\Area\CouncilsController;
use \App\Http\Controllers\Super\Area\DivisionsController;
use \App\Http\Controllers\Super\Area\WardsController;
use \App\Http\Controllers\Super\Area\BranchesController;
use \App\Http\Controllers\Super\Area\TrunksController;
use App\Http\Controllers\Super\Group\GroupsController;
use \App\Http\Controllers\Super\Leader\BranchLeadersController;
use App\Http\Controllers\Super\Leader\DivisionLeadersController;
use App\Http\Controllers\Super\Leader\WardLeadersController;
use App\Http\Controllers\Super\Leader\CouncilLeadersController;
use App\Http\Controllers\Super\Leader\DistrictLeadersController;
use App\Http\Controllers\Super\Leader\RegionLeadersController;
use App\Http\Controllers\Super\Leader\StateLeadersController;
use App\Http\Controllers\Super\Posts\PostsController;



Route::controller(\App\Http\Controllers\Super\Area\GeneralAreasController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/general')
    ->as('super.areas.general')
    ->group(function () {
        Route::get('/anzaKutafuta', 'searchIndex')->name('.anza');
    });



Route::controller(DistrictsController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/district')
    ->as('super.areas.wilaya.')
    ->group(function () {
        Route::get('/orodha', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(CouncilsController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/council')
    ->as('super.areas.halmashauri.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(DivisionsController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/division')
    ->as('super.areas.tarafa.')
    ->group(function () {
        Route::get('/orodha/{council}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(WardsController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/ward')
    ->as('super.areas.kata.')
    ->group(function () {
        Route::get('/orodha/{division}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(BranchesController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/branch')
    ->as('super.areas.tawi.')
    ->group(function () {
        Route::get('/orodha/{ward}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/fungua/{branch}', 'show')->name('fungua');
    });


Route::controller(TrunksController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/trunk')
    ->as('super.areas.shina.')
    ->group(function () {
        Route::get('/orodha/{branch}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/fungua/{trunk}', 'show')->name('fungua');
        Route::get('/badiri/{trunk}', 'update')->name('sahihisha');
    });



Route::controller(\App\Http\Controllers\Super\Area\StatesController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/areas/state')
    ->as('super.areas.jimbo.')
    ->group(function () {
        Route::get('/fungua/{state}', 'show')->name('fungua');
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(BranchLeadersController::class)
->middleware(['auth', 'role:super'])
->prefix('/super/leader/branch')
->as('super.leader.tawi.')
->group(function () {
    Route::get('/orodha/{ward}', 'index')->name('orodha');
    Route::post('/ongeza', 'store')->name('ongeza');
    Route::put('/badili/{leader}', 'update')->name('sasisha');
});

Route::controller( \App\Http\Controllers\Super\leader\TrunkLeadersController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/leader/trunk')
    ->as('super.leader.shina.')
    ->group(function () {
        Route::get('/orodha/{branch}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::put('/badili/{trunk}', 'update')->name('sasisha');
    });


Route::controller(WardLeadersController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/leader/ward')
    ->as('super.leader.kata.')
    ->group(function () {
        Route::get('/orodha/{division}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/badili/{leader}', 'update')->name('sasisha');
    });


Route::controller(DivisionLeadersController::class)
->middleware(['auth', 'role:super'])
->prefix('/super/leader/division')
->as('super.leader.tarafa.')
->group(function () {
    Route::get('/orodha/{council}', 'index')->name('orodha');
    Route::post('/ongeza', 'store')->name('ongeza');
    Route::get('/badili/{leader}', 'edit')->name('badili');

});


Route::controller(CouncilLeadersController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/leader/council')
    ->as('super.leader.halmashauri.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(DistrictLeadersController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/leader/district')
    ->as('super.leader.wilaya.')
    ->group(function () {
        Route::get('/orodha/{region}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/sasisha/{leader}', 'update')->name('sasisha');

    });


Route::controller(RegionLeadersController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/leader/region')
    ->as('super.leader.mkoa.')
    ->group(function () {
        Route::post('/ongeza', 'store')->name('ongeza');
        Route::get('/badili/{leader}', 'edit')->name('badili');
        Route::put('/sasisha/{leader}', 'update')->name('sasisha');
    });


Route::controller(StateLeadersController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/leader/state')
    ->as('super.leader.jimbo.')
    ->group(function () {
        Route::get('/orodha/{district}', 'index')->name('orodha');
        Route::post('/ongeza', 'store')->name('ongeza');
    });


Route::controller(GroupsController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/group')
    ->as('super.group.')
    ->group(function () {
        Route::get('/orodha/{side}', 'index')->name('orodha');
        Route::post('/toaWadhifa', 'removePost')->name('toaWadhifa');
        Route::post('/ongezaWadhifa', 'addPost')->name('ongezaWadhifa');
        Route::put('/rekebishaWadhifa/{group}', 'editGroup')->name('editWadhifa');
        Route::post('/sajiriWadhifa', 'storeWadhifa')->name('storeWadhifa');
        Route::put('/onaGroup/{group}', 'showSingleGroup')->name('showGroup');
});


Route::controller(PostsController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/wadhifa')
    ->as('super.posts.')
    ->group(function () {
        Route::get('/orodha/{side}', 'index')->name('orodha');
        Route::post('/ongezaWadhifa', 'store')->name('ongeza');
        Route::put('/badiriWadhifa/{post}', 'update')->name('updateWadhifa');
    });


Route::controller(\App\Http\Controllers\Super\ChallengesController::class)
->middleware(['auth', 'role:super'])
    ->prefix('/super/changamoto')
    ->as('super.challenge.')
    ->group(function () {
        Route::get('/fungua/{challenge}', 'show')->name('fungua');
        Route::put('/changamoto/{challenge}', 'updateChallenge')->name('updateChallenge');
        Route::get('/changamoto', 'index')->name('orodha');
        Route::put('/changamoto/weka/imakamilika/{challenge}', 'acomplished')->name('acomplished');
    });



Route::controller(\App\Http\Controllers\Super\SialsController::class)
     ->middleware(['auth', 'role:super'])
    ->prefix('/super/ziara')
    ->as('super.sial.')
    ->group(function () {
        Route::get('/orodhesha', 'index')->name('allList');
        Route::get('/ongeza', 'create')->name('create');
        Route::get('/fungua/{sial}', 'show')->name('show');
        Route::post('/jaza', 'store')->name('jaza');
    });


Route::controller(\App\Http\Controllers\Super\MotorsController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/vyombo/vya/moto')
    ->as('super.motor.')
    ->group(function () {
        Route::get('/orodhesha', 'index')->name('allList');
        Route::get('/orodhesha/service/{id}', 'orodhaMotorServices')->name('orodhaServices');
    });


Route::controller(\App\Http\Controllers\Super\ServicesController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/services/')
    ->as('super.service.')
    ->group(function () {
        Route::get('/orodhesha', 'index')->name('allList');
        Route::get('/moja/{id}', 'showService')->name('showService');
    });

// Route::controller(\App\Http\Controllers\Super\Area\WardsController::class)
//     ->group(function () {
//         Route::get('/watu/{id}', 'getbranchsApi')->name('create');
//     });


Route::controller(HousesController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/houses')
    ->as('super.houses.')
    ->group(function () {
        Route::get('/houses/show/{id}', 'show')->name('showHouse');
        Route::get('/all/houses', 'index')->name('allHouses');
        Route::post('/houses/create', 'store')->name('storeHouse');
    });

Route::controller(ApartmentsController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/apartment')
    ->as('super.apartment.')
    ->group(function () {
        Route::get('/show/{id}', 'show')->name('showApartment');
        Route::post('/store', 'store')->name('storeApartment');
        Route::get('/unpaid', 'unpaid')->name('unpaid');
    });

Route::controller(\App\Http\Controllers\Super\Payments\PaymentsController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/payment')
    ->as('super.payments.')
    ->group(function () {
        Route::post('/store', 'store')->name('storePayment');
        Route::post('/store/for/shop', 'storeForShop')->name('storeShopPayment');
    });

Route::controller(TenantsController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/tenants')
    ->as('super.tenants.')
    ->group(function () {
        Route::post('/assign', 'assignTenant')->name('assignTenant');
        Route::post('/store', 'storeTenant')->name('storeTenant');
        Route::post('/storeForShop', 'storeTenantForShop')->name('storeTenantForShop');
        Route::delete('/delete/{id}', 'deleteTenant')->name('deleteTenant');
    });

Route::controller(HouseTypesController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/houseTypes')
    ->as('super.houseTypes.')
    ->group(function () {
        Route::get('/', 'showAll')->name('showAll');
        Route::post('/store', 'storeHouseType')->name('storeHouseType');
    });


Route::controller(CharitiesController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/charity')
    ->as('super.charity.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('showCharity');
        Route::post('/store', 'store')->name('store');
    });


Route::controller(\App\Http\Controllers\Super\CharityCategoriesController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/charity/category')
    ->as('super.charityCategory.')
    ->group(function () {
        Route::post('/store', 'store')->name('store');
    });


Route::controller(\App\Http\Controllers\Super\LeadersController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/leader')
    ->as('super.leader.')
    ->group(function () {
        Route::put('/remove/from/power', 'removeFromPower')->name('unpower');
    });


Route::controller(\App\Http\Controllers\Super\AssistantsController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/assistants')
    ->as('super.assistants.')
    ->group(function () {
        Route::get('/list/all', 'index' )->name('index');
        Route::get('/list/show/{id}', 'show' )->name('show');
        Route::POST('/store', 'store' )->name('store');
        Route::post('/give/permission', 'givePermission')->name('givePermission');
        Route::post('/remove/permission', 'removePermission')->name('removePermission');
    });



Route::controller(ReceiversController::class)
    ->middleware(['auth', 'role:super'])
    ->prefix('/super/receivers')
    ->as('super.receivers.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
});







