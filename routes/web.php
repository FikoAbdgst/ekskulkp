<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\EkskulController;

// Halaman Depan (Siswa) - Tidak perlu login
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/daftar', [PublicController::class, 'store'])->name('daftar.store');

// Halaman Admin - Wajib Login
Auth::routes(['register' => false]); // Matikan registrasi admin publik

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [EkskulController::class, 'index'])->name('admin.dashboard');
    Route::post('/ekskul', [EkskulController::class, 'store'])->name('ekskul.store');
    // Tambahkan route delete/update jika perlu
});
