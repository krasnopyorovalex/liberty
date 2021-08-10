<?php

use App\Http\Controllers\Admin\FurnitureImageController;

Route::group(['prefix' => 'furniture-images', 'as' => 'furniture_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('furniture', '[0-9]+');

    Route::get('{furniture}', [FurnitureImageController::class, 'index'])->name('index');
    Route::post('{furniture}', [FurnitureImageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [FurnitureImageController::class, 'edit'])->name('edit');
    Route::put('{id}', [FurnitureImageController::class, 'update'])->name('update');
    Route::delete('{id}', [FurnitureImageController::class, 'destroy'])->name('destroy');

    Route::post('update-positions', [FurnitureImageController::class, 'updatePositions'])->name('update_positions');
});
