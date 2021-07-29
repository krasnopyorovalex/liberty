<?php

use App\Http\Controllers\Admin\MenuController;

Route::group(['prefix' => 'menus', 'as' => 'menus.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [MenuController::class, 'index'])->name('index');
    Route::get('create', [MenuController::class, 'create'])->name('create');
    Route::post('', [MenuController::class, 'store'])->name('store');
    Route::get('{id}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::put('{id}', [MenuController::class, 'update'])->name('update');
    Route::delete('{id}', [MenuController::class, 'destroy'])->name('destroy');
});
