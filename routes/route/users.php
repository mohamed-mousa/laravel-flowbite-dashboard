<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| users
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('users', [UserController::class, 'store'])->name('user.store');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/delete-users', [UserController::class, 'delete_users']);

    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('user-profile', [UserController::class, 'update_profile'])->name('profile.update');
    Route::post('removecover', [UserController::class, 'remove_cover'])->name('profile.removecover');
    Route::post('removeavatar', [UserController::class, 'remove_avatar'])->name('profile.removeavatar');
});
