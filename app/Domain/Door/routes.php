<?php

use App\Http\Controllers\Admin\DoorController;
use App\Http\Controllers\Admin\DoorModificationController;
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
    Route::delete('destroy-file/{id}', [DoorController::class, 'destroyFile'])->name('destroy.file');

    Route::post('store-textures/{id}', [DoorController::class, 'textures'])->name('store.textures');
    Route::delete('delete-textures/{id}', [DoorController::class, 'destroyTexture'])->name('destroy.texture');
});

Route::group(['prefix' => 'door-modifications', 'as' => 'door_modifications.'], function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('door', '[0-9]+');

    Route::get('{door}', [DoorModificationController::class, 'index'])->name('index');
    Route::get('create/{door}', [DoorModificationController::class, 'create'])->name('create');
    Route::post('', [DoorModificationController::class, 'store'])->name('store');
    Route::get('{id}/edit', [DoorModificationController::class, 'edit'])->name('edit');
    Route::put('{id}', [DoorModificationController::class, 'update'])->name('update');
    Route::delete('{id}', [DoorModificationController::class, 'destroy'])->name('destroy');
});
