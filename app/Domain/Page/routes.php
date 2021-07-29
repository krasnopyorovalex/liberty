<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [PageController::class, 'index'])->name('index');
    Route::get('create', [PageController::class, 'create'])->name('create');
    Route::post('', [PageController::class, 'store'])->name('store');
    Route::get('{id}/edit', [PageController::class, 'edit'])->name('edit');
    Route::put('{id}', [PageController::class, 'update'])->name('update');
    Route::delete('{id}', [PageController::class, 'destroy'])->name('destroy');
});
