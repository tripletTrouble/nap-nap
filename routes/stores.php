<?php

use App\Http\Controllers\StoreSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

Route::middleware(['auth'])->group(function () {
    Route::controller(StoreController::class)->group(function () {
        Route::get('/store/edit', 'edit')->name('store.edit');
        Route::put('/store/{store}', 'update')->name('store.update');
    });

    Route::controller(StoreSettingController::class)->group(function () {
        Route::get('/store/settings', 'index')->name('store.settings.index');
        Route::post('/store/{store}/settings', 'upsert')->name('store.settings.update');
    });
});

