<?php

use App\Http\Controllers\Admin\HowWeWorkController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'how-we-works', 'as' => 'how_we_works.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [HowWeWorkController::class, 'index'])->name('index');
    Route::get('create', [HowWeWorkController::class, 'create'])->name('create');
    Route::post('', [HowWeWorkController::class, 'store'])->name('store');
    Route::get('{id}/edit', [HowWeWorkController::class, 'edit'])->name('edit');
    Route::put('{id}', [HowWeWorkController::class, 'update'])->name('update');
    Route::delete('{id}', [HowWeWorkController::class, 'destroy'])->name('destroy');
});
