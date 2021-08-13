<?php

use App\Http\Controllers\Admin\DoorImageController;

Route::group(['prefix' => 'door-images', 'as' => 'door_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('Door', '[0-9]+');

    Route::get('{Door}', [DoorImageController::class, 'index'])->name('index');
    Route::post('{Door}', [DoorImageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [DoorImageController::class, 'edit'])->name('edit');
    Route::put('{id}', [DoorImageController::class, 'update'])->name('update');
    Route::delete('{id}', [DoorImageController::class, 'destroy'])->name('destroy');

    Route::post('update-positions', [DoorImageController::class, 'updatePositions'])->name('update_positions');
});
