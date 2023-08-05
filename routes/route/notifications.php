<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| notifications
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active.user'])->group(function () {
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('notification-set/{id}', [NotificationController::class, 'set'])->name('notification.set');
    Route::post('notifications-set', [NotificationController::class, 'set_all'])->name('notifications.set');
});
