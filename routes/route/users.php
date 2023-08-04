<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| users
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active.user', 'admin'])->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('users', [UserController::class, 'store'])->name('user.store');
    Route::post('user-active/{id}', [UserController::class, 'active'])->name('user.active');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('delete-users', [UserController::class, 'delete'])->name('users.destroy');
    Route::get('users/export/', [UserController::class, 'export'])->name('users.export');
    Route::get('users/pdf/', [UserController::class, 'pdf'])->name('users.pdf');
});

Route::middleware(['auth', 'active.user'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::delete('/profile-avatar-remove', [ProfileController::class, 'avatar_remove'])->name('profile.avatar.remove');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile-notification', [ProfileController::class, 'notification'])->name('profile.notification');
    Route::post('/profile-alert', [ProfileController::class, 'alert'])->name('profile.alert');
});
