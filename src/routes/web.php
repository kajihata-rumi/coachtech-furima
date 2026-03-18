<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/mypage/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/mypage/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});

require __DIR__.'/auth.php';
