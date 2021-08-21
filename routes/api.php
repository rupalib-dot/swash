<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\CustomerController;
use App\Http\Controllers\ApiController\LocationController;
use App\Http\Controllers\ApiController\CommonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::fallback(function(){
    return response()->json([
        'ResponseCode'  => 404,
        'status'        => False,
        'message'       => 'URL not found as you looking']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// CUSTOMER REGISTER, UPDATE, PROFILE API
Route::resource('customer', CustomerController::class)->only([
    'store', 'show', 'update'
]);

Route::post('login_account', [CommonController::class, 'login_account']);
Route::post('forgot_password', [CommonController::class, 'forgot_password']);
Route::post('reset_password', [CommonController::class, 'reset_password']);
Route::post('change_password', [CommonController::class, 'change_password']);
Route::post('resend_otp', [CommonController::class, 'resend_otp']);
Route::post('verify_account', [CommonController::class, 'verify_account']);
Route::get('application_setting', [CommonController::class, 'application_setting']);
Route::get('locations', [CommonController::class, 'locations']);
Route::post('checkAbility', [CommonController::class, 'checkAbility']);
Route::post('cartvalue', [CommonController::class, 'cartvalue']);
Route::post('totlePrice', [CommonController::class, 'totlePrice']);
Route::post('applyCoupon', [CommonController::class, 'applyCoupon']);
Route::post('removeCart', [CommonController::class, 'removeCart']);
Route::post('removecoupon', [CommonController::class, 'removecoupon']);
Route::post('order', [CommonController::class, 'order']);
Route::post('loyaltypoint', [CommonController::class, 'loyaltypoint']);
Route::post('removeloyalti', [CommonController::class, 'removeloyalti']);
Route::post('bookings', [CommonController::class, 'bookings']);
Route::post('reschedule', [CommonController::class, 'reschedule']);
Route::post('cancelrequest', [CommonController::class, 'cancelrequest']);



