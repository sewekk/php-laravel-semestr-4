<?php

use App\Http\Controllers\LeaveRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('can:create-leave-request')->group(function () {
        Route::get('/leave-requests', [LeaveRequestController::class, 'index'])->name('leave-requests.index');
        Route::post('/leave-requests', [LeaveRequestController::class, 'store'])->name('leave-requests.store');
    });

    Route::middleware('can:view-all-requests')->group(function () {
        Route::get('/leave-requests/manage', [LeaveRequestController::class, 'manage'])->name('leave-requests.manage');
    });

    Route::middleware('can:decide-on-request')->group(function () {
        Route::patch('/leave-requests/{leaveRequest}/approve', [LeaveRequestController::class, 'approve'])->name('leave-requests.approve');
        Route::patch('/leave-requests/{leaveRequest}/reject', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');
    });
});
