<?php

use App\Http\Controllers\Admin\SliderImageController;

Route::group(['prefix' => 'slider-images', 'as' => 'slider_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('slider', '[0-9]+');

    Route::get('{slider}', [SliderImageController::class, 'index'])->name('index');
    Route::post('{slider}', [SliderImageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [SliderImageController::class, 'edit'])->name('edit');
    Route::put('{id}', [SliderImageController::class, 'update'])->name('update');
    Route::delete('{id}', [SliderImageController::class, 'destroy'])->name('destroy');

    Route::post('update-positions', [SliderImageController::class, 'updatePositions'])->name('update_positions');
});
