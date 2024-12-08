<?php
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserCatalogueController;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Backend\OrderController as BackendOrder;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [MainController::class, 'index']);

Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);
/*USER*/
Route::group(['prefix' => 'user'], function() {
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('admin');
    Route::post('{id}/update', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.update')->middleware('admin');
    Route::get('{id}/edit', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.edit')->middleware('admin');
    Route::get('{id}/delete', [UserController::class, 'delete'])->where(['id' => '[0-9]+'])->name('user.delete')->middleware('admin');
    Route::delete('{id}/destroy', [UserController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('user.destroy')->middleware('admin');
});
Route::group(['prefix' => 'user/catalogue'], function() {
    Route::get('index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index')->middleware('admin');
    Route::get('create', [UserCatalogueController::class, 'create'])->name('user.catalogue.create')->middleware('admin');
    Route::post('store', [UserCatalogueController::class, 'store'])->name('user.catalogue.store')->middleware('admin');
    Route::post('{id}/update', [UserCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.catalogue.update')->middleware('admin');
    Route::get('{id}/edit', [UserCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.catalogue.edit')->middleware('admin');
    Route::get('{id}/delete', [UserCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('user.catalogue.delete')->middleware('admin');
    Route::delete('{id}/destroy', [UserCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('user.catalogue.destroy')->middleware('admin');
});
Route::group(['prefix' => 'language'], function() {
    Route::get('index', [LanguageController::class, 'index'])->name('language.index')->middleware('admin');
    Route::get('create', [LanguageController::class, 'create'])->name('language.create')->middleware('admin');
    Route::post('store', [LanguageController::class, 'store'])->name('language.store')->middleware('admin');
    Route::post('{id}/update', [LanguageController::class, 'update'])->where(['id' => '[0-9]+'])->name('language.update')->middleware('admin');
    Route::get('{id}/edit', [LanguageController::class, 'edit'])->where(['id' => '[0-9]+'])->name('language.edit')->middleware('admin');
    Route::get('{id}/delete', [LanguageController::class, 'delete'])->where(['id' => '[0-9]+'])->name('language.delete')->middleware('admin');
    Route::delete('{id}/destroy', [LanguageController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('language.destroy')->middleware('admin');
});
/*PRODUCT*/
Route::group(['prefix' => 'admin/product'], function() {
    Route::get('index', [ProductController::class, 'index'])->name('product.index');
    Route::get('create', [ProductController::class, 'create'])->name('product.create')->middleware('admin');
    Route::post('store', [ProductController::class, 'store'])->name('product.store')->middleware('admin');
    Route::post('{id}/update', [ProductController::class, 'update'])->where(['id' => '[0-9]+'])->name('product.update')->middleware('admin');
    Route::get('{id}/edit', [ProductController::class, 'edit'])->where(['id' => '[0-9]+'])->name('product.edit')->middleware('admin');
    Route::get('{id}/delete', [ProductController::class, 'delete'])->where(['id' => '[0-9]+'])->name('product.delete')->middleware('admin');
    Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('product.destroy')->middleware('admin');
});
/*ORDER*/
Route::group(['prefix' => 'admin/order'], function() {
    Route::get('index', [BackendOrder::class, 'index'])->name('order.index');
    Route::get('{id}/detail', [BackendOrder::class, 'detail'])->where(['id' => '[0-9]+'])->name('order.detail')->middleware('admin');
    Route::get('/orders/{order}/confirm', [BackendOrder::class, 'confirm'])->name('order.confirm');
    Route::post('/orders/bulk-confirm', [BackendOrder::class, 'bulkConfirm'])->name('orders.bulkConfirm');
    Route::post('/orders/bulk-unconfirm', [BackendOrder::class, 'bulkUnconfirm'])->name('orders.bulkUnconfirm');
    

    Route::get('{id}/delete', [BackendOrder::class, 'delete'])->where(['id' => '[0-9]+'])->name('order.delete')->middleware('admin');
    Route::delete('{id}/destroy', [BackendOrder::class, 'destroy'])->where(['id' => '[0-9]+'])->name('order.destroy')->middleware('admin');
});
/*AJAX*/
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index')->middleware('admin');
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware('admin');
Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware('admin');

Route::get('/home', [MainController::class, 'index']);
Route::get('/store', [MainController::class, 'store']);
Route::get('/store', [MainController::class, 'store'])->name('store');

Route::get('/store/shoetype={shoetype}', [MainController::class, 'findshoetype']);
Route::get('/store/searchshoetype', [MainController::class, 'searchShoeType'])->name('store.searchshoetype');
Route::get('/store/thuonghieu={thuonghieu}', [MainController::class, 'searchthuonghieu']);
Route::get('/store/price={price1}-{price2}', [MainController::class, 'searchprice']);
Route::get('/store/product/{slug}', [MainController::class, 'product'])->name('product.details');

Route::post('/search', [MainController::class, 'search']);
Route::get('/about-us', [MainController::class, 'aboutUs']);

Route::get('/gio-hang', [CartController::class, 'index'])->name('gio-hang');
Route::post('/gio-hang/cap-nhat', [CartController::class, 'update'])->name('cap-nhat-gio-hang');
Route::get('/gio-hang/xoa/id={id}', [CartController::class, 'destroy'])->name('xoa-khoi-gio-hang');
Route::get('/cua-hang/san-pham={id}/them', [CartController::class, 'addToCart'])->name('them-vao-gio-hang');

Route::get('/thanh-toan', [OrderController::class, 'index'])->name('thanh-toan');
Route::post('/thanh-toan', [OrderController::class, 'payment']);
Route::post('/thanh-toan/hoadon', [OrderController::class, 'store']);