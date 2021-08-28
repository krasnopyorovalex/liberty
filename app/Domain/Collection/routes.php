<?php

use App\Http\Controllers\Admin\CollectionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'collections', 'as' => 'collections.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [CollectionController::class, 'index'])->name('index');
    Route::get('create', [CollectionController::class, 'create'])->name('create');
    Route::post('', [CollectionController::class, 'store'])->name('store');
    Route::get('{id}/edit', [CollectionController::class, 'edit'])->name('edit');
    Route::put('{id}', [CollectionController::class, 'update'])->name('update');
    Route::delete('{id}', [CollectionController::class, 'destroy'])->name('destroy');

    Route::delete('destroy-image/{id}', [CollectionController::class, 'destroyImage'])->name('destroy.img');
    Route::delete('destroy-image-mob/{id}', [CollectionController::class, 'destroyImageMob'])->name('destroy.img.mob');
    Route::delete('destroy-file/{id}', [CollectionController::class, 'destroyFile'])->name('destroy.file');
});
