<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PenggunaanController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\PembayaranController; // baru


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mendaftarkan semua rute untuk aplikasi web kita.
|
*/

// Rute untuk Tamu (yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'registerCreate'])->name('register');
    Route::post('register', [AuthController::class, 'registerStore']);
    Route::get('login', [AuthController::class, 'loginCreate'])->name('login');
    Route::post('login', [AuthController::class, 'loginAuthenticate']);
});


// Grup Rute untuk yang sudah login
Route::middleware('auth')->group(function () {

    // Rute Logout (berlaku untuk semua role)
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // --- RUTE KHUSUS ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Mengganti semua rute tarif dengan satu baris ini
        Route::resource('tarif', TarifController::class)->except(['show']);

        // Rute untuk mengelola pelanggan
        Route::resource('pelanggan', PelangganController::class)->except(['show']);

        // Rute untuk mengelola penggunaan
        Route::resource('penggunaan', PenggunaanController::class)->except(['show']);

        // Rute untuk mengelola tagihan
        Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
        Route::post('/tagihan/generate/{penggunaan}', [TagihanController::class, 'generate'])->name('tagihan.generate');

        // Rute Verifikasi Pembayaran
        Route::get('/pembayaran/verify/{tagihan}', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    });

    // --- RUTE KHUSUS PELANGGAN ---
    Route::middleware('role:pelanggan')->prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/dashboard', [PelangganDashboardController::class, 'index'])->name('dashboard');
        // Tambahkan rute pelanggan lainnya di sini...
    });

});
