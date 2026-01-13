<?php

use App\Http\Controllers\WorkTimeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/work-times', [WorkTimeController::class, 'index'])->name('work-times.index');

    Route::middleware('can:add-work-time')->group(function () {
        Route::post('/work-times', [WorkTimeController::class, 'store'])->name('work-times.store');
    });

    Route::middleware('can:view-all-work-times')->group(function () {
        Route::get('/work-times/manage', [WorkTimeController::class, 'manage'])->name('work-times.manage');
    });

    Route::middleware('can:manage-work-times')->group(function () {
        Route::patch('/work-times/{workTime}/approve', [WorkTimeController::class, 'approve'])->name('work-times.approve');
        Route::patch('/work-times/{workTime}/reject', [WorkTimeController::class, 'reject'])->name('work-times.reject');
    });
});
