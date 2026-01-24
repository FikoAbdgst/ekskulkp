<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\EkskulController;
use App\Http\Controllers\Admin\SiswaController;

// Halaman Depan
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/daftar', [PublicController::class, 'store'])->name('daftar.store');
Route::post('/check-siswa', [PublicController::class, 'checkSiswa'])->name('check.siswa'); // Route baru AJAX

Auth::routes(['register' => false]);

// Halaman Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('ekskul', EkskulController::class);
    Route::get('/ekskul/{id}/detail', [EkskulController::class, 'show'])->name('ekskul.show');
    Route::delete('/ekskul/{ekskulId}/siswa/{siswaId}', [EkskulController::class, 'removeSiswa'])->name('ekskul.removeSiswa');

    // Siswa Management
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store'); // Create Manual
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import'); // Import Excel
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
});
