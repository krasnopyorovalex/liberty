<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\Form\CalculateController;
use App\Http\Controllers\Form\GuestbookController;
use App\Http\Controllers\Form\RecallController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\InteriorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
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

Route::pattern('alias', '[\da-z-]+');

Route::group(['prefix' => '_root', 'middleware' => 'auth', 'as' => 'admin.'], function () {

    Route::get('', [HomeController::class, 'home'])->name('home');

    Route::post('upload-ckeditor', [CkeditorController::class, 'upload'])->name('upload-ckeditor');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }
});

Route::group(['prefix' => 'form', 'as' => 'form.'], function () {
    Route::post('calculate', CalculateController::class)->name('calculate');
    Route::post('recall', RecallController::class)->name('recall');
    Route::post('guestbook', GuestbookController::class)->name('guestbook');
});

Route::group(['middleware' => ['redirector']], static function () {
    Route::get('search', SearchController::class)->name('search');
    Route::get('autocomplete', FavoriteController::class)->name('autocomplete');

    Route::get('{alias?}', PageController::class)->name('page.show');
    Route::get('author/{alias}', AuthorController::class)->name('author.show');
    Route::get('collections/{alias}', CollectionController::class)->name('collection.show');
    Route::get('interiors/{alias}', InteriorController::class)->name('interior.show');
    Route::get('doors/{alias}', DoorController::class)->name('door.show');
    Route::get('furniture/{alias}', FurnitureController::class)->name('furniture.show');
});
