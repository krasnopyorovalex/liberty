<?php

use App\Http\Controllers\Admin\DoorInteriorSliderImageController;

Route::group(['prefix' => 'door-interior-slider-images', 'as' => 'door_interior_slider_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('slider', '[0-9]+');

    Route::get('{slider}', [DoorInteriorSliderImageController::class, 'index'])->name('index');
    Route::post('{slider}', [DoorInteriorSliderImageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [DoorInteriorSliderImageController::class, 'edit'])->name('edit');
    Route::put('{id}', [DoorInteriorSliderImageController::class, 'update'])->name('update');
    Route::delete('{id}', [DoorInteriorSliderImageController::class, 'destroy'])->name('destroy');

    Route::post('update-positions', [DoorInteriorSliderImageController::class, 'updatePositions'])->name('update_positions');
});
