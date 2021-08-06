<?php

use App\Http\Controllers\Admin\ForClientController;

Route::group(['prefix' => 'for-clients', 'as' => 'for_clients.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [ForClientController::class, 'index'])->name('index');
    Route::get('create', [ForClientController::class, 'create'])->name('create');
    Route::post('', [ForClientController::class, 'store'])->name('store');
    Route::get('{id}/edit', [ForClientController::class, 'edit'])->name('edit');
    Route::put('{id}', [ForClientController::class, 'update'])->name('update');
    Route::delete('{id}', [ForClientController::class, 'destroy'])->name('destroy');
});
