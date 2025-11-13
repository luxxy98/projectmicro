<?php

use App\Http\Controllers\Content\PortalController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

// Route::get('/', [PortalController::class, 'login'])->name('index');
// Route::post('/login', [PortalController::class, 'logindb'])->name('logindb');
Route::get('/logout', [PortalController::class, 'logout'])->name('logout');
Route::get('log-viewer', [LogViewerController::class, 'index'])->name('log-viewer');
Route::post('log-error', [PortalController::class, 'error'])->name('log-error');


Route::middleware('web')->group(function () {
    // Halaman tampilan (GET) untuk UI auth dari Project 2
    Route::view('/login', 'auth.login')->middleware('guest')->name('login');
    Route::view('/register', 'auth.register')->middleware('guest')->name('register');
    Route::view('/otp', 'auth.otp')->middleware('guest')->name('otp.page'); // opsional untuk cek tampilan OTP
});

// Opsional (kalau kamu copas juga)
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::view('/reset-password', 'auth.reset-password')->name('password.reset');
Route::view('/verify-email', 'auth.verify-email')->name('verification.notice');

// Halaman tampilan (GET) untuk preview UI
// Route::view('/login', 'auth.login')->name('login');                // tampilan login
// Route::view('/register', 'auth.register')->name('register');       // tampilan register
// Route::view('/otp', 'auth.otp')->name('otp.page');                 // tampilan OTP (opsional jika mau buka via GET)