<?php

use App\Http\Controllers\Admin\InteriorTypeController;

Route::group(['prefix' => 'interior-types', 'as' => 'interior_types.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [InteriorTypeController::class, 'index'])->name('index');
    Route::get('create', [InteriorTypeController::class, 'create'])->name('create');
    Route::post('', [InteriorTypeController::class, 'store'])->name('store');
    Route::get('{id}/edit', [InteriorTypeController::class, 'edit'])->name('edit');
    Route::put('{id}', [InteriorTypeController::class, 'update'])->name('update');
    Route::delete('{id}', [InteriorTypeController::class, 'destroy'])->name('destroy');
});
