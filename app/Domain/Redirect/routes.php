<?php

use App\Http\Controllers\Admin\RedirectController;

Route::group(['prefix' => 'redirects', 'as' => 'redirects.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [RedirectController::class, 'index'])->name('index');
    Route::get('create', [RedirectController::class, 'create'])->name('create');
    Route::post('', [RedirectController::class, 'store'])->name('store');
    Route::get('{id}/edit', [RedirectController::class, 'edit'])->name('edit');
    Route::put('{id}', [RedirectController::class, 'update'])->name('update');
    Route::delete('{id}', [RedirectController::class, 'destroy'])->name('destroy');
});
