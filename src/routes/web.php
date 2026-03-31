<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;

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

        Route::get('/purchase/success', [PurchaseController::class, 'success'])
    ->name('purchase.success');

        Route::get('/purchase/{item}', [PurchaseController::class, 'create'])
    ->name('purchase.create');

    Route::get('/purchase/address/{item}', [PurchaseController::class, 'address'])
    ->name('purchase.address');

    Route::post('/purchase/address/{item}', [PurchaseController::class, 'updateAddress'])
    ->name('purchase.address.update');

    Route::post('/item/{item}/comment', [CommentController::class, 'store'])
    ->name('comment.store');

    Route::post('/purchase/{item}/checkout', [PurchaseController::class, 'checkout'])
    ->name('purchase.checkout');

Route::get('/purchase/cancel/{item}', [PurchaseController::class, 'cancel'])
    ->name('purchase.cancel');
});

require __DIR__.'/auth.php';