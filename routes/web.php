<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\PagesController as AdminPagesController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\{PermissionController, CodeController, RoleController, UserController, PagesController, DistributorSaleController, DsLoginHistoryController, BrandController, ImportController, DashboardController, PromoterController, StateController, CityController, PincodeController, WholesalerController, PayoutController, OrderController, WDController, WholesalerSurveyFormController,LatestCodeController,LatestWholesalerController,LatestOrderController};
use App\Http\Controllers\Customer\PageController as CustomerPageController;
use App\Http\Controllers\Web\PagesController as WebPagesController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => ['guest:web']], function () {
        Route::get('/', [AdminLoginController::class, 'create']);
        Route::get('login', [AdminLoginController::class, 'create'])->name('auth.login');
        Route::post('login/check', [AdminLoginController::class, 'store'])->name('auth.check');
    });
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');

    Route::group(['middleware' => ['auth', 'auth.gates']], function () {

        Route::get('home', [AdminPagesController::class, 'index'])->name('home');
        Route::get('dashboard-outlet-data-list', [DashboardController::class, 'outletData'])->name('dashboard-outlet-data.list');
        Route::get('profile', [AdminPagesController::class, 'profile'])->name('profile');
        Route::get('login-histories', [AdminPagesController::class, 'loginHistory'])->name('login_history');
        Route::get('login-histories-list', [AdminPagesController::class, 'loginHistoryList'])->name('login_history_list');
        Route::group(['prefix' => 'export', 'as' => 'exports.'], function () {
            Route::get('/', [ExportController::class, 'index'])->name('index');
            Route::post('data', [ExportController::class, 'export'])->name('data');
        });

        //Import
        Route::resource('imports', ImportController::class);

        // Permissions
        Route::resource('permissions', PermissionController::class);
        Route::get('permission-list', [PermissionController::class, 'permissionList'])->name('permission.list');
        Route::post('bulk-permissions-upload', [PermissionController::class, 'bulkUpload'])->name('bulk_permissions_upload');

        // Roles
        Route::get('roles/{role_id}/permissions', [RoleController::class, 'permissions'])->name('more-permission-for-role');
        Route::resource('roles', RoleController::class);
        Route::get('role-list', [RoleController::class, 'roleList'])->name('role.list');

        // Users
        Route::get('users/{user_id}/roles', [UserController::class, 'roles'])->name('more-role-for-user');
        Route::resource('users', UserController::class);
        Route::get('user-list', [UserController::class, 'userList'])->name('users.list');

        //Dashboard Data
        Route::get('count-data', [DashboardController::class, 'countData'])->name('count_data');
        Route::get('lastest-customer', [DashboardController::class, 'latestCustomer'])->name('latest-customers.list');
        Route::get('wholesaler-enrollment', [DashboardController::class, 'wholesalerEnrollment'])->name('wholesaler_enrollment');
        Route::get('wholesaler-participation', [DashboardController::class, 'wholesalerParticipation'])->name('wholesaler_participation');
        Route::get('top-wholesalers-list', [DashboardController::class, 'topWholesalerList'])->name('top-wholesalers.list');
        Route::get('payout-data', [DashboardController::class, 'payoutData'])->name('payout_data');
        Route::get('brand-wise-sale', [DashboardController::class, 'brandWiseSale'])->name('brand-wise-sale');
        Route::get('location-wise-sale', [DashboardController::class, 'locationWiseSale'])->name('location-wise-sale');
        Route::get('wholesaler-login-history', [DashboardController::class, 'wholesalerLoginHistory'])->name('wholesaler-login-history');
        Route::get('wd-wise-sale', [DashboardController::class, 'wdWiseSale'])->name('wd-wise-sale');
        Route::get('order-by-usertype', [DashboardController::class, 'orderByUsertype'])->name('order-by-usertype');
        Route::get('coupon-utilization', [DashboardController::class, 'couponUtilization'])->name('coupon-utilization');
        Route::get('set-region-session', [DashboardController::class, 'setRegionSession'])->name('set-region-session');

        //Generate Code
        Route::resource('generate-codes', CodeController::class);
        Route::get('generate-codes-list', [CodeController::class, 'generateCodeList'])->name('generate_codes.list');

        // Route::get('view-generate-code', [CodeController::class, 'create'])->name('view_generate_code');
        Route::post('generate-code', [CodeController::class, 'generateCode'])->name('generate_code');
        Route::get('change-code', [CodeController::class, 'changeCode'])->name('change_code');
        Route::post('store-change-code', [CodeController::class, 'storeChangeCode'])->name('store_change_code');
        Route::get('get-wd-ref-code', [CodeController::class, 'getRefWdCode'])->name('get-wd-ref-code');
        Route::get('get-brand-ref-code', [CodeController::class, 'getRefBrandCode'])->name('get-brand-ref-code');

        //States
        Route::resource('states', StateController::class);
        Route::get('states-list', [StateController::class, 'stateList'])->name('states.list');
        Route::get('state-wholesalers-list', [StateController::class, 'stateWholesalerList'])->name('state.wholesalers.list');
        Route::get('state-orders-list', [StateController::class, 'stateOrderList'])->name('state.orders.list');
        Route::post('bulk-states-upload', [StateController::class, 'bulkstatesUpload'])->name('bulk_states_upload');

        //Cities
        Route::resource('cities', CityController::class);
        Route::get('city-list', [CityController::class, 'cityList'])->name('city.list');
        Route::get('city-wholesalers-list', [CityController::class, 'cityWholesalerList'])->name('city.wholesalers.list');
        Route::get('city-orders-list', [CityController::class, 'cityOrderList'])->name('city.orders.list');
        Route::post('bulk-cities-upload', [CityController::class, 'bulkcityUpload'])->name('bulk_cities_upload');
        Route::get('get-cities/{state_id}', [CityController::class, 'getCities'])->name('get.cities');

        //Pincodes
        Route::resource('pincodes', PincodeController::class);
        Route::get('pincodes-list', [PincodeController::class, 'pincodeList'])->name('pincodes.list');
        Route::get('pincode-wholesalers-list', [PincodeController::class, 'pincodeWholesalerList'])->name('pincode.wholesalers.list');
        Route::get('pincode-orders-list', [PincodeController::class, 'pincodeOrderList'])->name('pincode.orders.list');
        Route::post('bulk-pincodes-upload', [PincodeController::class, 'bulkpincodesUpload'])->name('bulk_pincodes_upload');
        Route::get('get-pincodes/{city_id}', [PincodeController::class, 'getPincodes'])->name('get.pincodes');

        //Wholesalers
        Route::resource('wholesalers', WholesalerController::class);
        Route::get('wholesalers-list', [WholesalerController::class, 'wholesalerList'])->name('wholesalers.list');
        Route::post('bulk-wholesalers-upload', [WholesalerController::class, 'bulkUpload'])->name('bulk_wholesalers_upload');
        Route::get('view-wholesalers-login-histories', [WholesalerController::class, 'wholesalerLoginHistory'])->name('view_wholesalers_login_histories');
        Route::get('wholesalers-login-history-list', [WholesalerController::class, 'wholesalerLoginHistoryList'])->name('wholesalers_login_histories.list');
        Route::get('wholesalers-order', [WholesalerController::class, 'wholesalerOrderList'])->name('wholesaler.orders.list');

        //Wholesalers-survey-form
        Route::resource('wholesalers-survey-form', WholesalerSurveyFormController::class);
        Route::get('wholesalers-survey-form-list', [WholesalerSurveyFormController::class, 'wholesalerSurveyFormList'])->name('wholesalers-survey-form.list');
        Route::get('/admin/wholesaler-survey-form/{survey_id}', [WholesalerSurveyFormController::class, 'wholesalerSurveyFormDelete'])->name('wholesaler-survey-form.destroy');


        //Payouts
        Route::resource('payouts', PayoutController::class);
        Route::get('payouts-list', [PayoutController::class, 'payoutList'])->name('payouts.list');
        Route::post('bulk-payouts-upload', [PayoutController::class, 'bulkPayoutsUpload'])->name('bulk_payouts_upload');

        //Order
        Route::resource('orders', OrderController::class);
        Route::get('orders-list', [OrderController::class, 'orderList'])->name('orders.list');

        //WD
        Route::resource('wds', WDController::class);
        Route::get('wd-list', [WDController::class, 'wdList'])->name('wds.list');
        Route::post('bulk-wd-upload', [WDController::class, 'bulkUpload'])->name('bulk_wd_upload');
        Route::get('wd-order', [WDController::class, 'wdOrderList'])->name('wd.orders.list');
        Route::get('wd-code', [WDController::class, 'wdCodeList'])->name('wd.codes.list');

        //Brands
        Route::resource('brands', BrandController::class);
        Route::get('brand-list', [BrandController::class, 'brandList'])->name('brands.list');
        Route::post('bulk-brand-upload', [BrandController::class, 'bulkUpload'])->name('bulk_brand_upload');
        Route::get('brand-order', [BrandController::class, 'brandOrderList'])->name('brand.orders.list');
        Route::get('brand-code', [BrandController::class, 'brandCodeList'])->name('brand.codes.list');

        Route::resource('latest-codes', LatestCodeController::class);
        Route::get('latest-codes-list', [LatestCodeController::class, 'latestCodeList'])->name('latest_codes.list');
        // Route::post('latest_generate-code', [LatestCodeController::class, 'generateCode'])->name('latest_generate_code');

        Route::resource('latest-wholesalers', LatestWholesalerController::class);
        Route::get('latest-wholesalers-list', [LatestWholesalerController::class, 'latestWholesalerList'])->name('latest-wholesalers.list');

        Route::resource('latest-orders', LatestOrderController::class);
        Route::get('latest-orders-list', [LatestOrderController::class, 'latestOrderList'])->name('latest-orders.list');

        Route::get('/make-payout', [AdminPagesController::class, 'makePayout']);
        Route::get('/check-payout-status', [AdminPagesController::class, 'checkPayoutStatus']);
        
    });

});


Route::get('index', [WebPagesController::class, 'index'])->name('index');
Route::get('about-us', [WebPagesController::class, 'aboutUs'])->name('about-us');
Route::get('services', [WebPagesController::class, 'services'])->name('services');
Route::get('contact-us', [WebPagesController::class, 'contactUs'])->name('contact-us');


