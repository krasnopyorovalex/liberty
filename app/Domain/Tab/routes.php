<?php

use App\Http\Controllers\Admin\TabController;

Route::group(['prefix' => 'tabs', 'as' => 'tabs.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [TabController::class, 'index'])->name('index');
    Route::get('create', [TabController::class, 'create'])->name('create');
    Route::post('', [TabController::class, 'store'])->name('store');
    Route::get('{id}/edit', [TabController::class, 'edit'])->name('edit');
    Route::put('{id}', [TabController::class, 'update'])->name('update');
    Route::delete('{id}', [TabController::class, 'destroy'])->name('destroy');
});
