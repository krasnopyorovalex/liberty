<?php

use App\Http\Controllers\Admin\DoorInteriorSliderController;

Route::group(['prefix' => 'door-interior-sliders', 'as' => 'door_interior_sliders.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('doorId', '[0-9]+');

    Route::get('{id}/edit/{doorId}', [DoorInteriorSliderController::class, 'edit'])->name('edit');
    Route::put('{id}', [DoorInteriorSliderController::class, 'update'])->name('update');

    Route::post('upload', [DoorInteriorSliderController::class, 'upload'])->name('upload');
});
