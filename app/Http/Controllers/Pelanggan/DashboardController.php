<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- PENTING
use App\Models\Tagihan;
use App\Models\Penggunaan;

class DashboardController extends Controller
{
    public function index()
    {
        // LOGIKA BARU DI SINI
        // 1. Ambil user yang sedang login
        $user = Auth::user();

        // 2. Cari data pelanggan yang terhubung dengan user ini
        $pelanggan = $user->pelanggan;

        $semua_tagihan = []; // Defaultnya array kosong

        // 3. Jika data pelanggan ditemukan, cari semua tagihannya
        if ($pelanggan) {
            // Ambil semua ID penggunaan milik pelanggan ini
            $penggunaanIds = Penggunaan::where('id_pelanggan', $pelanggan->id_pelanggan)->pluck('id_penggunaan');

            // Ambil semua tagihan yang id_penggunaan-nya ada di dalam daftar di atas
            $semua_tagihan = Tagihan::whereIn('id_penggunaan', $penggunaanIds)
                ->with('penggunaan') // Ambil juga data penggunaannya
                ->get();
        }

        // 4. Kirim data tagihan ke view
        return view('pelanggan.dashboard', compact('semua_tagihan'));
    }
}
