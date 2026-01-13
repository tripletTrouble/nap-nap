<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

Route::middleware(['auth'])->controller(StoreController::class)->group(function () {
    Route::get('/store/edit', 'edit')->name('store.edit');
    Route::put('/store/{store}', 'update')->name('store.update');
});