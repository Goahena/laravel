<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\Ajax\LocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);
/*USER*/
Route::group(['prefix' => 'user'], function() {
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('admin');
    Route::post('{id}/update', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.update')->middleware('admin');
    Route::get('{id}/edit', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.edit')->middleware('admin');
    // Route::post('{id}/delete', [UserController::class, 'delete'])->name('user.delete')->middleware('admin');

});
/*AJAX*/
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index')->middleware('admin');

