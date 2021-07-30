<?php

use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'why-choose-us', 'as' => 'why_choose_us.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [WhyChooseUsController::class, 'index'])->name('index');
    Route::get('create', [WhyChooseUsController::class, 'create'])->name('create');
    Route::post('', [WhyChooseUsController::class, 'store'])->name('store');
    Route::get('{id}/edit', [WhyChooseUsController::class, 'edit'])->name('edit');
    Route::put('{id}', [WhyChooseUsController::class, 'update'])->name('update');
    Route::delete('{id}', [WhyChooseUsController::class, 'destroy'])->name('destroy');

    Route::delete('destroy-image/{id}', [WhyChooseUsController::class, 'destroyImage'])->name('destroy.img');
    Route::delete('destroy-image-mob/{id}', [WhyChooseUsController::class, 'destroyImageMob'])->name('destroy.img.mob');
});
