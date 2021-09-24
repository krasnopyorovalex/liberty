<?php

use App\Http\Controllers\Admin\BlockController;

Route::group(['prefix' => 'blocks', 'as' => 'blocks.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [BlockController::class, 'index'])->name('index');
    Route::get('create', [BlockController::class, 'create'])->name('create');
    Route::post('', [BlockController::class, 'store'])->name('store');
    Route::get('{id}/edit', [BlockController::class, 'edit'])->name('edit');
    Route::put('{id}', [BlockController::class, 'update'])->name('update');
    Route::delete('{id}', [BlockController::class, 'destroy'])->name('destroy');
});
