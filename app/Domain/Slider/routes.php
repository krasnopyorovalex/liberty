<?php

use App\Http\Controllers\Admin\SliderController;

Route::group(['prefix' => 'sliders', 'as' => 'sliders.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [SliderController::class, 'index'])->name('index');
    Route::get('create', [SliderController::class, 'create'])->name('create');
    Route::post('', [SliderController::class, 'store'])->name('store');
    Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
    Route::put('{id}', [SliderController::class, 'update'])->name('update');
    Route::delete('{id}', [SliderController::class, 'destroy'])->name('destroy');

    Route::post('upload', [SliderController::class, 'upload'])->name('upload');
});
