<?php

use App\Http\Controllers\Admin\DoorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doors', 'as' => 'doors.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [DoorController::class, 'index'])->name('index');
    Route::get('create', [DoorController::class, 'create'])->name('create');
    Route::post('', [DoorController::class, 'store'])->name('store');
    Route::get('{id}/edit', [DoorController::class, 'edit'])->name('edit');
    Route::put('{id}', [DoorController::class, 'update'])->name('update');
    Route::delete('{id}', [DoorController::class, 'destroy'])->name('destroy');

    Route::delete('destroy-image/{id}', [DoorController::class, 'destroyImage'])->name('destroy.img');
    Route::delete('destroy-image-mob/{id}', [DoorController::class, 'destroyImageMob'])->name('destroy.img.mob');
    Route::delete('destroy-file/{id}', [DoorController::class, 'destroyFile'])->name('destroy.file');
});
