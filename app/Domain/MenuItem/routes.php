<?php

use App\Http\Controllers\Admin\MenuItemController;

Route::group(['prefix' => 'menu-items', 'as' => 'menu_items.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('menu', '[0-9]+');

    Route::get('{menu}', [MenuItemController::class, 'index'])->name('index');
    Route::get('create/{menu}', [MenuItemController::class, 'create'])->name('create');
    Route::post('', [MenuItemController::class, 'store'])->name('store');
    Route::get('{id}/edit', [MenuItemController::class, 'edit'])->name('edit');
    Route::put('{id}', [MenuItemController::class, 'update'])->name('update');
    Route::delete('{id}', [MenuItemController::class, 'destroy'])->name('destroy');

    Route::post('sorting/{parent}', [MenuItemController::class, 'sorting'])->name('sorting');
});
