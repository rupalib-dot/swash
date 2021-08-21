<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\BlackdateController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\BookingController;

Route::get('/', [LoginController::class, 'loginPage'])->name('login');
Route::get('login', [LoginController::class, 'loginPage'])->name('login');
Route::post('login-submit', [LoginController::class, 'loginSubmit'])->name('loginSubmit');

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::group(['middleware' => 'check-admin'], function () {
        Route::get('dashboard', [DashboardController::class, 'homeIndex'])->name('dashboard');
        Route::get('logouta-admin', [LoginController::class, 'logoutAdmin'])->name('logoutAdmin');
        Route::resource('client', ClientController::class);
        Route::get('update-status/{id}', [ClientController::class, 'updateStatus'])->name('updateStatus');

        // Locations Route
        Route::resource('locations', LocationController::class);
        Route::get('locations-delete/{id}',[ LocationController::class, 'delete'])->name('locations.delete');

        // Teams Route
        Route::resource('teams', TeamController::class);
        Route::get('teams-delete/{id}',[ TeamController::class, 'delete'])->name('teams.delete');

        // Teams Route
        Route::resource('blackout', BlackdateController::class);
        Route::get('blackout-delete/{id}',[ BlackdateController::class, 'delete'])->name('blackout.delete');

        // Coupons
        Route::resource('coupons', CouponsController::class);
        Route::get('coupons-delete/{id}',[ CouponsController::class, 'delete'])->name('coupons.delete');
        Route::get('referral-coupon',[ CouponsController::class, 'referralCoupon'])->name('referralCoupon');

        // Setting
        Route::get('application-settings',[ SettingController::class, 'settingPage'])->name('settingPage');
        Route::post('update-application-settings',[ SettingController::class, 'updateSetting'])->name('updateSetting');

        // Booking
        Route::resource('booking',BookingController::class);

    });
});


