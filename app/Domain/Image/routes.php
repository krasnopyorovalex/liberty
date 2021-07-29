<?php

use App\Http\Controllers\Admin\ImageController;

Route::group(['prefix' => 'images', 'as' => 'images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::put('{id}', [ImageController::class, 'update'])->name('update');
    Route::delete('{id}', [ImageController::class, 'destroy'])->name('destroy');
});
