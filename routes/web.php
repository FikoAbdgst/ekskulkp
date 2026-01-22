<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\EkskulController;
use App\Http\Controllers\Admin\SiswaController; // Pastikan controller ini sudah dibuat

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Depan (Public/Siswa)
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/daftar', [PublicController::class, 'store'])->name('daftar.store');

// 2. Authentication Routes (Login, Logout, dll)
// Baris ini PENTING untuk mengatasi error "Route [logout] not defined"
Auth::routes(['register' => false]);

// 3. Halaman Admin (Wajib Login)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Pastikan file view ini ada
    })->name('dashboard');

    // CRUD Ekskul (Otomatis: index, create, store, edit, update, destroy)
    Route::resource('ekskul', EkskulController::class);

    // Manage Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
});
