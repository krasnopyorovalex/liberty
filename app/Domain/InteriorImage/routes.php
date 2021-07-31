<?php

use App\Http\Controllers\Admin\InteriorImageController;

Route::group(['prefix' => 'interior-images', 'as' => 'interior_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('interior', '[0-9]+');

    Route::get('{interior}', [InteriorImageController::class, 'index'])->name('index');
    Route::post('{interior}', [InteriorImageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [InteriorImageController::class, 'edit'])->name('edit');
    Route::put('{id}', [InteriorImageController::class, 'update'])->name('update');
    Route::delete('{id}', [InteriorImageController::class, 'destroy'])->name('destroy');

    Route::post('update-positions', [InteriorImageController::class, 'updatePositions'])->name('update_positions');
});
