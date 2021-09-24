<?php

use App\Http\Controllers\Admin\ContactController;

Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [ContactController::class, 'index'])->name('index');
    Route::get('create', [ContactController::class, 'create'])->name('create');
    Route::post('', [ContactController::class, 'store'])->name('store');
    Route::get('{id}/edit', [ContactController::class, 'edit'])->name('edit');
    Route::put('{id}', [ContactController::class, 'update'])->name('update');
    Route::delete('{id}', [ContactController::class, 'destroy'])->name('destroy');
});
