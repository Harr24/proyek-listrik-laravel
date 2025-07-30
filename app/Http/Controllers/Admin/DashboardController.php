<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk admin.
     */
    public function index()
    {
        $jumlah_pelanggan = Pelanggan::count();
        $tagihan_belum_lunas = Tagihan::where('status', 'Belum Lunas')->count();

        // --- PERBAIKAN LOGIKA DI SINI ---
        // 1. Buat array untuk menerjemahkan nama bulan
        $daftarBulanInggris = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        // 2. Ambil nama bulan saat ini dalam bahasa Inggris
        $bulanInggris = Carbon::now()->format('F');

        // 3. Terjemahkan ke bahasa Indonesia
        $bulanIndonesia = $daftarBulanInggris[$bulanInggris];

        // 4. Gunakan nama bulan bahasa Indonesia di dalam query
        $pendapatan_bulan_ini = Tagihan::where('status', 'Lunas')
            ->whereHas('penggunaan', function ($query) use ($bulanIndonesia) {
                $query->where('bulan', $bulanIndonesia)
                    ->where('tahun', Carbon::now()->year);
            })->sum('total_bayar');
        // --- AKHIR PERBAIKAN ---

        return view('admin.dashboard', compact('jumlah_pelanggan', 'tagihan_belum_lunas', 'pendapatan_bulan_ini'));
    }
}
