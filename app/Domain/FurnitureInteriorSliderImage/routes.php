<?php

use App\Http\Controllers\Admin\FurnitureInteriorSliderImageController;

Route::group(['prefix' => 'furniture-interior-slider-images', 'as' => 'furniture_interior_slider_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('slider', '[0-9]+');

    Route::get('{slider}', [FurnitureInteriorSliderImageController::class, 'index'])->name('index');
    Route::post('{slider}', [FurnitureInteriorSliderImageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [FurnitureInteriorSliderImageController::class, 'edit'])->name('edit');
    Route::put('{id}', [FurnitureInteriorSliderImageController::class, 'update'])->name('update');
    Route::delete('{id}', [FurnitureInteriorSliderImageController::class, 'destroy'])->name('destroy');

    Route::post('update-positions', [FurnitureInteriorSliderImageController::class, 'updatePositions'])->name('update_positions');
});
