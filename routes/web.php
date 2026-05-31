<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

// ==========================================
// 1. PUBLIC ROUTES (Bisa diakses siapa saja)
// ==========================================
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/product/{slug}', [FrontController::class, 'show'])->name('product.show');

// SEARCH ROUTE
Route::get('/search', [FrontController::class, 'search'])->name('search');

// POPULAR AND ALL PRODUCTS ROUTE
Route::get('/popular-products', [FrontController::class, 'popular'])->name('products.popular');
Route::get('/all-products', [FrontController::class, 'allProducts'])->name('products.all');

// INI ADALAH ROUTE KATEGORI YANG MEMBUAT ERROR TADI:
Route::get('/category/{slug}', [FrontController::class, 'category'])->name('category.show');


// ==========================================
// 2. GUEST ROUTES (Hanya untuk yang belum login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/auth', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


// ==========================================
// 3. AUTH ROUTES (Hanya untuk yang sudah login)
// ==========================================
Route::middleware('auth')->group(function () {

    // Auth & Profile Actions
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/forgot-password', function () {
    return view('front.forgot-password');
})->name('password.request');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.store');

    // Orders & Checkout
    Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/checkout/{slug}', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/{slug}', [OrderController::class, 'store'])->name('order.store');

    // Cart (Keranjang)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{slug}', [CartController::class, 'store'])->name('cart.add');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Email Verification
    Route::get('/email/verify', function () {
        return view('front.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('profile');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim ulang!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    Route::post('/product/{slug}/review', [FrontController::class, 'storeReview'])->name('review.store');
});


// ==========================================
// 4. PROTECTED ROUTES (Harus login & email verified)
// ==========================================
Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('profile');
