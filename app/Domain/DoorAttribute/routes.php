<?php

use App\Http\Controllers\Admin\DoorAttributeController;

Route::group(['prefix' => 'door-attributes', 'as' => 'door_attributes.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [DoorAttributeController::class, 'index'])->name('index');
    Route::get('create', [DoorAttributeController::class, 'create'])->name('create');
    Route::post('', [DoorAttributeController::class, 'store'])->name('store');
    Route::get('{id}/edit', [DoorAttributeController::class, 'edit'])->name('edit');
    Route::put('{id}', [DoorAttributeController::class, 'update'])->name('update');
    Route::delete('{id}', [DoorAttributeController::class, 'destroy'])->name('destroy');
});
