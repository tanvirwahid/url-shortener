<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ShortUrlController;
use App\Http\Controllers\Auth\Admin\SessionController;

Route::middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/urls', [ShortUrlController::class, 'index'])->name('admin.urls');
    Route::post('/logout', [SessionController::class, 'destroy'])->name('admin.logout');
});

Route::middleware('admin-guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('admin.login');
    Route::post('/login', [SessionController::class, 'store'])->name('admin.login.store');
});
