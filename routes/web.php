<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user_id}/deactivate', [\App\Http\Controllers\UserController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('/users/{user_id}/activate', [\App\Http\Controllers\UserController::class, 'activate'])->name('users.activate');
});

require __DIR__.'/settings.php';
require __DIR__.'/stores.php';
