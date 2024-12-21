<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveReportController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::controller(AuthenticationController::class)->group(function(){
    Route::get('register', 'showRegistrationForm')->name('registeration.form');
    Route::post('register', 'register')->name('register');

    Route::get('/', 'showLoginForm');
    Route::get('login', 'showLoginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
});

Route::get('get-states/{country}', [LocationController::class, 'getStates'])->name('get.states');
Route::get('get-cities/{state}', [LocationController::class, 'getCities'])->name('get.cities');

Route::middleware('custom.auth')->group(function(){
    Route::controller(AuthenticationController::class)->group(function(){
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'showProfile')->name('profile.show');
        Route::post('update-profile', 'updateProfile')->name('update.profile');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::controller(LeaveController::class)->group(function(){
        Route::get('leave-request', 'showLeaveForm')->name('leave.form');
        Route::get('leave-list', 'listLeaves')->name('leave.list');

        Route::post('submit-leave', 'submitLeaveRequest')->name('leave.submit');
        Route::get('/leave-edit/{id}', 'editLeave')->name('leave.edit');
        Route::post('/leave-update/{id}', 'updateLeave')->name('leave.update');
        Route::get('/leave-delete/{id}', 'deleteLeave')->name('leave.delete');
    });

    Route::controller(LeaveReportController::class)->group(function(){
        Route::get('/leave-report', 'leaveReport')->name('leave.report');
    });
});
