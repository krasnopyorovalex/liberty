<?php

use App\Http\Controllers\Admin\FurnitureController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'furniture', 'as' => 'furniture.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [FurnitureController::class, 'index'])->name('index');
    Route::get('create', [FurnitureController::class, 'create'])->name('create');
    Route::post('', [FurnitureController::class, 'store'])->name('store');
    Route::get('{id}/edit', [FurnitureController::class, 'edit'])->name('edit');
    Route::put('{id}', [FurnitureController::class, 'update'])->name('update');
    Route::delete('{id}', [FurnitureController::class, 'destroy'])->name('destroy');

    Route::delete('destroy-image/{id}', [FurnitureController::class, 'destroyImage'])->name('destroy.img');
    Route::delete('destroy-image-mob/{id}', [FurnitureController::class, 'destroyImageMob'])->name('destroy.img.mob');
    Route::delete('destroy-file/{id}', [FurnitureController::class, 'destroyFile'])->name('destroy.file');
});
