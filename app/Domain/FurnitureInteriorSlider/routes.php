<?php

use App\Http\Controllers\Admin\FurnitureInteriorSliderController;

Route::group(['prefix' => 'furniture-interior-sliders', 'as' => 'furniture_interior_sliders.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('furnitureId', '[0-9]+');

    Route::get('{id}/edit/{furnitureId}', [FurnitureInteriorSliderController::class, 'edit'])->name('edit');
    Route::put('{id}', [FurnitureInteriorSliderController::class, 'update'])->name('update');

    Route::post('upload', [FurnitureInteriorSliderController::class, 'upload'])->name('upload');
});
