<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\SalesLeadersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'sales-leaders', 'as' => 'sales_leaders.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [SalesLeadersController::class, 'index'])->name('index');
    Route::get('create', [SalesLeadersController::class, 'create'])->name('create');
    Route::post('', [SalesLeadersController::class, 'store'])->name('store');
    Route::get('{id}/edit', [SalesLeadersController::class, 'edit'])->name('edit');
    Route::put('{id}', [SalesLeadersController::class, 'update'])->name('update');
    Route::delete('{id}', [SalesLeadersController::class, 'destroy'])->name('destroy');

    Route::delete('destroy-image/{id}', [SalesLeadersController::class, 'destroyImage'])->name('destroy.img');
    Route::delete('destroy-image-mob/{id}', [SalesLeadersController::class, 'destroyImageMob'])->name('destroy.img.mob');
});
