<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employees', 'as' => 'employees.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', [EmployeeController::class, 'index'])->name('index');
    Route::get('create', [EmployeeController::class, 'create'])->name('create');
    Route::post('', [EmployeeController::class, 'store'])->name('store');
    Route::get('{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::put('{id}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('{id}', [EmployeeController::class, 'destroy'])->name('destroy');

    Route::post('positions', [EmployeeController::class, 'positions']);
});
