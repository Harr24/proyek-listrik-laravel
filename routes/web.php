<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BeritaController; // berita
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PenggunaanController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Pelanggan\PembayaranController as PelangganPembayaranController;
use App\Http\Controllers\Admin\KeluhanController as AdminKeluhanController; //admin
use App\Http\Controllers\Pelanggan\KeluhanController as PelangganKeluhanController; // Keluhan

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
// Daftar Harga home
Route::get('/daftar-harga', [HomeController::class, 'daftarHarga'])->name('daftar-harga');
// Rute untuk Tamu (yang belum login)
Route::middleware('guest')->group(function () {
    //Route::get('register', [AuthController::class, 'registerCreate'])->name('register');
    //Route::post('register', [AuthController::class, 'registerStore']);
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

        Route::resource('tarif', TarifController::class)->except(['show']);
        Route::resource('pelanggan', PelangganController::class)->except(['show']);
        //penggunaan

        Route::get('/penggunaan/belum-input', [PenggunaanController::class, 'belumInputIndex'])->name('penggunaan.belum_input');
        Route::resource('penggunaan', PenggunaanController::class)->except(['show']);

        Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
        Route::post('/tagihan/generate/{penggunaan}', [TagihanController::class, 'generate'])->name('tagihan.generate');

        // Rute untuk verifikasi dan detail pembayaran oleh admin
        Route::get('/pembayaran/verify/{tagihan}', [AdminPembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran/store', [AdminPembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/show/{tagihan}', [AdminPembayaranController::class, 'show'])->name('pembayaran.show');

        // Rute untuk Konfirmasi Pembayaran
        Route::get('/konfirmasi-pembayaran', [AdminPembayaranController::class, 'konfirmasiIndex'])->name('pembayaran.konfirmasi.index');
        Route::get('/konfirmasi-pembayaran/{tagihan}', [AdminPembayaranController::class, 'konfirmasiShow'])->name('pembayaran.konfirmasi.show');
        Route::post('/konfirmasi-pembayaran/approve/{tagihan}', [AdminPembayaranController::class, 'konfirmasiApprove'])->name('pembayaran.konfirmasi.approve');
        Route::post('/konfirmasi-pembayaran/reject/{tagihan}', [AdminPembayaranController::class, 'konfirmasiReject'])->name('pembayaran.konfirmasi.reject');

        // Rute untuk Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [LaporanController::class, 'exportExcel'])->name('laporan.export');
        //berita admin
        Route::resource('berita', BeritaController::class)->except(['show']);
        // KEluhan
        Route::resource('keluhan', AdminKeluhanController::class)->only(['index', 'show']);
        // PERBAIKAN: Menambahkan rute untuk balasan dan status dari admin
        Route::post('/keluhan/{keluhan}/balas', [AdminKeluhanController::class, 'storeBalasan'])->name('keluhan.balas');
        Route::post('/keluhan/{keluhan}/status', [AdminKeluhanController::class, 'updateStatus'])->name('keluhan.status');
    });

    // --- RUTE KHUSUS PELANGGAN ---
    Route::middleware('role:pelanggan')->prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/dashboard', [PelangganDashboardController::class, 'index'])->name('dashboard');

        // Rute untuk proses pembayaran oleh pelanggan
        Route::get('/pembayaran/{tagihan}', [PelangganPembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PelangganPembayaranController::class, 'store'])->name('pembayaran.store');
        //struk
        Route::get('/struk/{tagihan}', [PelangganPembayaranController::class, 'show'])->name('pembayaran.show');
        // Keluhan
        Route::resource('keluhan', PelangganKeluhanController::class)->only(['index', 'create', 'store', 'show']);
        Route::post('/keluhan/{keluhan}/balas', [PelangganKeluhanController::class, 'storeBalasan'])->name('keluhan.balas');
    });

});
