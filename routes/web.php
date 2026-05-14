<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ─── Public Catalog ────────────────────────────────────────────────────────
Route::get('/', [PublicController::class, 'index'])->name('catalog');

// ─── Auth ──────────────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// ─── Forgot / Reset Password OTP ───────────────────────────────────────────
// Alur: email → OTP → verifikasi OTP → ubah password
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendOtp'])
    ->middleware('guest')
    ->name('password.otp.send');

Route::get('/verify-otp', [PasswordResetController::class, 'showOtpForm'])
    ->middleware('guest')
    ->name('password.otp.form');

Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp'])
    ->middleware('guest')
    ->name('password.otp.verify');

Route::get('/change-password', [PasswordResetController::class, 'showChangePasswordForm'])
    ->middleware('guest')
    ->name('password.change.form');

Route::post('/change-password', [PasswordResetController::class, 'changePassword'])
    ->middleware('guest')
    ->name('password.change.update');

// ─── Google SSO ────────────────────────────────────────────────────────────
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// ─── Protected Routes ──────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);

    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Users
    Route::resource('users', UserController::class)->except(['show']);

    // Stock In
    Route::get('/stock-in', [StockInController::class, 'index'])->name('stock_ins.index');
    Route::get('/stock-in/create', [StockInController::class, 'create'])->name('stock_ins.create');
    Route::post('/stock-in', [StockInController::class, 'store'])->name('stock_ins.store');

    // Stock Out
    Route::get('/stock-out', [StockOutController::class, 'index'])->name('stock_outs.index');
    Route::get('/stock-out/create', [StockOutController::class, 'create'])->name('stock_outs.create');
    Route::post('/stock-out', [StockOutController::class, 'store'])->name('stock_outs.store');

    // Transaction History
    Route::get('/transactions', [TransactionHistoryController::class, 'index'])->name('transactions.index');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/restock', [ReportController::class, 'restock'])->name('reports.restock');
});