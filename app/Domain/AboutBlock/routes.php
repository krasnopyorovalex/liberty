<?php

use App\Http\Controllers\Admin\AboutBlockController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'about-blocks', 'as' => 'about_blocks.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [AboutBlockController::class, 'index'])->name('index');
    Route::get('create', [AboutBlockController::class, 'create'])->name('create');
    Route::post('', [AboutBlockController::class, 'store'])->name('store');
    Route::get('{id}/edit', [AboutBlockController::class, 'edit'])->name('edit');
    Route::put('{id}', [AboutBlockController::class, 'update'])->name('update');
    Route::delete('{id}', [AboutBlockController::class, 'destroy'])->name('destroy');

    Route::delete('destroy-image/{id}', [AboutBlockController::class, 'destroyImage'])->name('destroy.img');
    Route::delete('destroy-image-mob/{id}', [AboutBlockController::class, 'destroyImageMob'])->name('destroy.img.mob');
});
