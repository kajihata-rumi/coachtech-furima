<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/mypage/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/mypage/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/sell', [SellController::class, 'create'])
        ->name('sell.create');

    Route::post('/sell', [SellController::class, 'store'])
        ->name('sell.store');

    Route::post('/item/{item}/like', [LikeController::class, 'store'])
        ->name('like.store');

    Route::delete('/item/{item}/like', [LikeController::class, 'destroy'])
        ->name('like.destroy');

        Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])
    ->name('purchase.create');

});

require __DIR__.'/auth.php';