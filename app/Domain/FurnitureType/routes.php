<?php

use App\Http\Controllers\Admin\FurnitureTypeController;

Route::group(['prefix' => 'furniture-types', 'as' => 'furniture_types.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [FurnitureTypeController::class, 'index'])->name('index');
    Route::get('create', [FurnitureTypeController::class, 'create'])->name('create');
    Route::post('', [FurnitureTypeController::class, 'store'])->name('store');
    Route::get('{id}/edit', [FurnitureTypeController::class, 'edit'])->name('edit');
    Route::put('{id}', [FurnitureTypeController::class, 'update'])->name('update');
    Route::delete('{id}', [FurnitureTypeController::class, 'destroy'])->name('destroy');
});
