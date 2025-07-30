<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tagihan;
use App\Models\Penggunaan;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil user yang sedang login
        $user = Auth::user();

        // 2. Cari data pelanggan yang terhubung dengan user ini
        $pelanggan = $user->pelanggan;

        $semua_tagihan = []; // Defaultnya array kosong
        // Variabel untuk data grafik, diinisialisasi sebagai array kosong
        $chartLabels = [];
        $chartData = [];

        // 3. Jika data pelanggan ditemukan, cari semua tagihannya
        if ($pelanggan) {
            // Ambil semua ID penggunaan milik pelanggan ini
            $penggunaanIds = Penggunaan::where('id_pelanggan', $pelanggan->id_pelanggan)->pluck('id_penggunaan');

            // Ambil semua tagihan yang id_penggunaan-nya ada di dalam daftar di atas
            $semua_tagihan = Tagihan::whereIn('id_penggunaan', $penggunaanIds)
                ->with('penggunaan')
                ->get();

            // Logika untuk menyiapkan data grafik
            // Ambil data penggunaan 12 bulan terakhir, diurutkan dari yang terlama
            $penggunaanTerakhir = Penggunaan::where('id_pelanggan', $pelanggan->id_pelanggan)
                ->orderBy('tahun', 'asc')
                ->orderByRaw("FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
                ->limit(12)
                ->get();

            foreach ($penggunaanTerakhir as $penggunaan) {
                // Buat label (contoh: Jan 24)
                $chartLabels[] = substr($penggunaan->bulan, 0, 3) . ' ' . substr($penggunaan->tahun, -2);
                // Hitung dan masukkan data pemakaian
                $chartData[] = $penggunaan->meter_akhir - $penggunaan->meter_awal;
            }
        }

        // 4. Kirim data tagihan dan data grafik ke view
        return view('pelanggan.dashboard', compact('semua_tagihan', 'chartLabels', 'chartData'));
    }
}
