<?php

use App\Http\Controllers\Admin\CollectionImageController;

Route::group(['prefix' => 'collection-images', 'as' => 'collection_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('furniture', '[0-9]+');

    Route::get('{furniture}', [CollectionImageController::class, 'index'])->name('index');
    Route::post('{furniture}', [CollectionImageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [CollectionImageController::class, 'edit'])->name('edit');
    Route::put('{id}', [CollectionImageController::class, 'update'])->name('update');
    Route::delete('{id}', [CollectionImageController::class, 'destroy'])->name('destroy');

    Route::post('update-positions', [CollectionImageController::class, 'updatePositions'])->name('update_positions');
});
