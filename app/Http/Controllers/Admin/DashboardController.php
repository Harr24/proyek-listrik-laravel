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

        // --- PERBAIKAN LOGIKA DI SINI ---
        // Menghitung semua tagihan yang statusnya BUKAN 'Lunas'
        $tagihan_belum_lunas = Tagihan::where('status', '!=', 'Lunas')->count();
        // --- AKHIR PERBAIKAN ---

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

        $bulanInggris = Carbon::now()->format('F');
        $bulanIndonesia = $daftarBulanInggris[$bulanInggris];

        $pendapatan_bulan_ini = Tagihan::where('status', 'Lunas')
            ->whereHas('penggunaan', function ($query) use ($bulanIndonesia) {
                $query->where('bulan', $bulanIndonesia)
                    ->where('tahun', Carbon::now()->year);
            })->sum('total_bayar');

        return view('admin.dashboard', compact('jumlah_pelanggan', 'tagihan_belum_lunas', 'pendapatan_bulan_ini'));
    }
}
