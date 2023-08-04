<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteSettingController;

/*
|--------------------------------------------------------------------------
| settings
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active.user'])->group(function () {
    Route::get('settings', [SiteSettingController::class, 'index'])->name('settings');
    Route::patch('/settings', [SiteSettingController::class, 'update'])->name('settings.update');

    Route::post('/settings-logo', [SiteSettingController::class, 'logo'])->name('settings.logo');
    Route::delete('/settings-logo-remove', [SiteSettingController::class, 'logo_remove'])->name('settings.logo.remove');

    Route::post('/settings-cover', [SiteSettingController::class, 'cover'])->name('settings.cover');
    Route::delete('/settings-cover-remove', [SiteSettingController::class, 'cover_remove'])->name('settings.cover.remove');
});
