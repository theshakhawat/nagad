<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Websites Management
    Route::patch('websites/{website}/toggle-status', [WebsiteController::class, 'toggleStatus'])->name('admin.websites.toggle-status');
    Route::resource('websites', WebsiteController::class)->names('admin.websites');

    // Profile & Password routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('admin.change-password');
    Route::put('/change-password', [ProfileController::class, 'updatePassword'])->name('admin.password.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/pay', [HomeController::class, 'pay']);
