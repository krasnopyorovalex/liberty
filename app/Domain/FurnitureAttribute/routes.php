<?php

use App\Http\Controllers\Admin\FurnitureAttributeController;

Route::group(['prefix' => 'furniture-attributes', 'as' => 'furniture_attributes.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [FurnitureAttributeController::class, 'index'])->name('index');
    Route::get('create', [FurnitureAttributeController::class, 'create'])->name('create');
    Route::post('', [FurnitureAttributeController::class, 'store'])->name('store');
    Route::get('{id}/edit', [FurnitureAttributeController::class, 'edit'])->name('edit');
    Route::put('{id}', [FurnitureAttributeController::class, 'update'])->name('update');
    Route::delete('{id}', [FurnitureAttributeController::class, 'destroy'])->name('destroy');
});
