<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan dan memfilter data tagihan.
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Mulai query ke tabel tagihan
        $query = Tagihan::query()->with('penggunaan.pelanggan');

        // Terapkan filter jika bulan dan tahun diisi
        if ($bulan && $tahun) {
            $query->whereHas('penggunaan', function ($q) use ($bulan, $tahun) {
                $q->where('bulan', $bulan)->where('tahun', $tahun);
            });
        }

        $semua_tagihan = $query->get();

        // Hitung total pendapatan hanya dari tagihan yang lunas
        $total_pendapatan = $semua_tagihan->where('status', 'Lunas')->sum('total_bayar');

        // TAMBAHAN BARU: Hitung jumlah pelanggan unik dari data tagihan yang ada
        $jumlah_pelanggan = $semua_tagihan->pluck('penggunaan.pelanggan.id_pelanggan')->unique()->count();

        return view('admin.laporan.index', compact('semua_tagihan', 'total_pendapatan', 'bulan', 'tahun', 'jumlah_pelanggan'));
    }

    /**
     * Mengekspor data laporan ke file Excel (CSV).
     */
    public function exportExcel(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = Tagihan::query()->with('penggunaan.pelanggan');

        if ($bulan && $tahun) {
            $query->whereHas('penggunaan', function ($q) use ($bulan, $tahun) {
                $q->where('bulan', $bulan)->where('tahun', $tahun);
            });
        }

        $semua_tagihan = $query->get();

        $fileName = 'laporan_tagihan_' . ($bulan ? $bulan . '_' : '') . ($tahun ? $tahun . '_' : '') . date('Ymd') . '.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Nama Pelanggan', 'Nomor Meter', 'Periode', 'Jumlah Meter (KWH)', 'Total Bayar', 'Status');

        $callback = function () use ($semua_tagihan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($semua_tagihan as $tagihan) {
                $row['Nama Pelanggan'] = $tagihan->penggunaan->pelanggan->nama_pelanggan ?? 'N/A';
                $row['Nomor Meter'] = $tagihan->penggunaan->pelanggan->nomor_meter ?? 'N/A';
                $row['Periode'] = ($tagihan->penggunaan->bulan ?? 'N/A') . ' ' . ($tagihan->penggunaan->tahun ?? '');
                $row['Jumlah Meter (KWH)'] = $tagihan->jumlah_meter;
                $row['Total Bayar'] = $tagihan->total_bayar;
                $row['Status'] = $tagihan->status;

                fputcsv($file, array($row['Nama Pelanggan'], $row['Nomor Meter'], $row['Periode'], $row['Jumlah Meter (KWH)'], $row['Total Bayar'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
