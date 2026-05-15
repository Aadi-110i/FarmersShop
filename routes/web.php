<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/marketplace', [ProductController::class, 'index'])->name('products.index');
    Route::get('/my-products', [ProductController::class, 'myProducts'])->name('products.my-products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/{product}/buy', [ProductController::class, 'buy'])->name('products.buy');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Review Routes
    Route::post('/products/{product}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    // Simulated Checkout
    Route::get('/products/{product}/checkout', function(App\Models\Product $product) {
        return view('products.checkout', compact('product'));
    })->name('products.checkout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

