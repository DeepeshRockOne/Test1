<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Test\Facades\TestFacades;
use Illuminate\Support\Facades\Facade;
//use Illuminate\Support\Facades\App;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::controller(OrderController::class)->group(function(){
    Route::get('test1', 'viewTest1')->name('view.test1');
    Route::get('test2/{param1?}', 'viewTest2')->name('view.test2');
    Route::get('test3', 'redirectToTest2')->name('redirect.test2');
    Route::get('view_orders', 'viewOrders')->name('veiw.oders');
    Route::get('test4', 'viewTest4')->name('view.test4');
    Route::get('test5', 'viewTest5')->name('view.test5');
    Route::get('send_email_test5', 'sendEemailTest5')->name('send.email.test5');
});
Route::get('facadess', function(){
    return TestFacades::testingFacades();
});
Route::get('loginWithG', [GoogleController::class, 'viewloginWithG'])->name('view.loginWithG');
Route::get('auth/google', [GoogleController::class, 'loginWithGoogle'])->name('login.with.google');
Route::get('auth/google/callback/', [GoogleController::class, 'callbackFromGoogle'])->name('callback.from.google');
Route::get('glogout', [GoogleController::class, 'glogout'])->name('glogout');
Route::get('home', function(){
    return view('home');
})->name('home');

Route::controller(ProductController::class)->group(function(){
    Route::get('add_product', 'addProduct')->name('add.product');
    Route::post('add_product', 'store')->name('store.product');
    Route::get('delete_product_image/{delete_id}', 'deleteImage')->name('delete.product.image');
    Route::get('view_products', 'show')->name('view.products');
    Route::get('view_product_images/{product_id}', 'viewProductImages')->name('view.product.images');

    Route::post('add_product_ajax', 'storeUsingAjax')->name('store.product.ajax');
    Route::get('edit_product_ajax/{edit_id}', 'editUsingAjax')->name('edit.product.ajax');
    Route::get('count_product_images_ajax/{product_id}', 'countProductImagesAjax')->name('count.product.images.ajax');
    Route::get('delete_product_ajax/{delete_id}', 'deleteUsingAjax')->name('delete.product.ajax');
});
