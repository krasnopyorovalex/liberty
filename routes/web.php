<?php

use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => ['redirector', 'shortcode']], static function () {
    Route::get('{alias}', PageController::class)->name('page.show');
    Route::get('articles/{alias}', 'BlogController@show')->name('sales_leader.show');
});


Route::post('send-order-product', 'FormHandlerController@orderProduct')->name('send.order_product');

Route::group(['prefix' => '_root', 'middleware' => 'auth', 'as' => 'admin.'], function () {

    Route::get('', [HomeController::class, 'home'])->name('home');

    Route::post('upload-ckeditor', [CkeditorController::class, 'upload'])->name('upload-ckeditor');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }
});
