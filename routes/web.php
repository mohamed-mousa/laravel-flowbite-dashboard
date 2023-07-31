<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

Route::get('language/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'ar'])) {
        abort(400);
    }
    app()->setLocale($lang);
    session()->put('locale', $lang);
    return Redirect::back();
})->name('setlocale');

include('route/users.php');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'active.user'])->name('dashboard');

Route::get('/not-active-user', function () {
    return Inertia::render('Auth/NotActive');
})->name('not-active-user');


require __DIR__ . '/auth.php';
