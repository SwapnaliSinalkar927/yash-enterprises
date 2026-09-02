<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\Wati\WebhookController as WatiWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Wati API
Route::post('/wati-webhook/check-user', [WatiWebhookController::class, 'checkUser']);
Route::post('/wati-webhook/name', [WatiWebhookController::class, 'handleName']);
Route::post('/wati-webhook/pincode', [WatiWebhookController::class, 'handlePincode']);
Route::post('/wati-webhook/coupon-code', [WatiWebhookController::class, 'handleCouponCode']);
Route::get('/delete-wholesaler', [WatiWebhookController::class, 'deleteWholesalers']);
Route::post('/wati-webhook/store-location', [WatiWebhookController::class, 'storeLocation']);
Route::post('/wati-webhook/save-location', [WatiWebhookController::class, 'saveLocation']);

Route::get('amcharts-country', function() {
    return response()->json(
        [
            "country_code"=>"IN",
            "country_name"=>"India"
        ]
    );
})->name('amcharts.country');


// Test
Route::post('/wati-webhook/welcome-user', [WatiWebhookController::class, 'welcomeUser']);
Route::post('/wati-webhook/get-user-name', [WatiWebhookController::class, 'getUserName']);
Route::post('/wati-webhook/save-image', [WatiWebhookController::class, 'saveImage']);
Route::post('/wati-webhook/check-new-user', [WatiWebhookController::class, 'checkNewUser']);
Route::post('/wati-webhook/new-name', [WatiWebhookController::class, 'newName']);
Route::post('/wati-webhook/new-pincode', [WatiWebhookController::class, 'newPincode']);
Route::post('/wati-webhook/new-upi-id', [WatiWebhookController::class, 'newUpiId']);
Route::post('/wati-webhook/new-quantum-sale', [WatiWebhookController::class, 'newQuantumSale']);
Route::post('/wati-webhook/new-coupon-code', [WatiWebhookController::class, 'newCouponCode']);
Route::post('/wati-webhook/latest-coupon-code', [WatiWebhookController::class, 'latestCouponCode']);
Route::post('/wati-webhook/new-user-type', [WatiWebhookController::class, 'newUserType']);
Route::post('/wati-webhook/get-tl-mobile-number', [WatiWebhookController::class, 'getTLMobileNumber']);
Route::post('/wati-webhook/latest-has-location', [WatiWebhookController::class, 'latestHasLocation']);
Route::post('/wati-webhook/check-summary', [WatiWebhookController::class, 'checkSummary']);