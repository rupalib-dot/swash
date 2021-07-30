<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;


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

// Route::get('/', function () {
//     return view('welcome_old');
// });

//clear cache route
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    echo '<script>alert("cache clear Success")</script>';
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    echo '<script>alert("config cache Success")</script>';
});
Route::get('/view', function () {
    Artisan::call('view:clear');
    echo '<script>alert("view clear Success")</script>';
});
Route::get('/route', function () {
    Artisan::call('route:cache');
    echo '<script>alert("route clear Success")</script>';
});
Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    echo '<script>alert("config clear Success")</script>';
});
Route::get('/storage', function () {
    Artisan::call('storage:link');
    echo '<script>alert("linked")</script>';
});

Route::get('', [HomeController::class, 'home_index'])->name('home');

// ADMIN LOGIN, FORGOT PASSWORD ROUTE
Route::get('admin', [HomeController::class, 'login_index']);
Route::post('login', [HomeController::class, 'login_user'])->name('admin.login');
Route::get('forget_password', [HomeController::class, 'forgot_password'])->name('admin.forget.password');
Route::post('forget_password', [HomeController::class, 'generate_token'])->name('admin.password.token');

Route::group(['middleware' => 'prevent-back-history'], function() {

    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware(['admin','role:ROLE_ADMIN|ROLE_SUBADMIN']);
        Route::get('logout', [DashboardController::class, 'logout_admin'])->name('admin.logout')->middleware(['admin','role:ROLE_ADMIN|ROLE_SUBADMIN']);

        
        Route::resource('notifications', NotificationController::class)->middleware(['admin','role:ROLE_ADMIN|ROLE_SUBADMIN']);
        Route::resource('orders', OrderController::class)->middleware(['admin','role:ROLE_ADMIN|ROLE_SUBADMIN']);
        Route::resource('customers', CustomerController::class)->middleware(['admin','role:ROLE_ADMIN|ROLE_SUBADMIN']);
        Route::get('destroy/{id}', [CustomerController::class, 'destroy'])->name('customers.delete')->middleware(['admin','role:ROLE_ADMIN|ROLE_SUBADMIN']);
    });
});
 
// ->middleware(['admin','role:ROLE_ADMIN|ROLE_AGENT|ROLE_PARTNER'])


