<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authors', 'as' => 'authors.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [AuthorController::class, 'index'])->name('index');
    Route::get('create', [AuthorController::class, 'create'])->name('create');
    Route::post('', [AuthorController::class, 'store'])->name('store');
    Route::get('{id}/edit', [AuthorController::class, 'edit'])->name('edit');
    Route::put('{id}', [AuthorController::class, 'update'])->name('update');
    Route::delete('{id}', [AuthorController::class, 'destroy'])->name('destroy');

    Route::post('positions', [AuthorController::class, 'positions']);
});
