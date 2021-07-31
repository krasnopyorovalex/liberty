<?php

use App\Http\Controllers\Admin\InteriorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'interiors', 'as' => 'interiors.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [InteriorController::class, 'index'])->name('index');
    Route::get('create', [InteriorController::class, 'create'])->name('create');
    Route::post('', [InteriorController::class, 'store'])->name('store');
    Route::get('{id}/edit', [InteriorController::class, 'edit'])->name('edit');
    Route::put('{id}', [InteriorController::class, 'update'])->name('update');
    Route::delete('{id}', [InteriorController::class, 'destroy'])->name('destroy');

    Route::delete('destroy-image/{id}', [InteriorController::class, 'destroyImage'])->name('destroy.img');
    Route::delete('destroy-image-mob/{id}', [InteriorController::class, 'destroyImageMob'])->name('destroy.img.mob');
});
