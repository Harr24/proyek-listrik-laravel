<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Penggunaan;
use App\Models\Tarif; // Pastikan ini ada
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Menampilkan daftar semua tagihan.
     */
    public function index(Request $request)
    {
        // LOGIKA BARU UNTUK FILTER
        $query = Tagihan::with('penggunaan.pelanggan');

        // Filter berdasarkan nama pelanggan
        if ($request->filled('search_nama')) {
            $search_nama = $request->input('search_nama');
            $query->whereHas('penggunaan.pelanggan', function ($q) use ($search_nama) {
                $q->where('nama_pelanggan', 'like', '%' . $search_nama . '%');
            });
        }

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $bulan = $request->input('bulan');
            $query->whereHas('penggunaan', function ($q) use ($bulan) {
                $q->where('bulan', $bulan);
            });
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $tahun = $request->input('tahun');
            $query->whereHas('penggunaan', function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        }

        // Filter berdasarkan jenis daya (tarif)
        if ($request->filled('id_tarif')) {
            $id_tarif = $request->input('id_tarif');
            $query->whereHas('penggunaan.pelanggan', function ($q) use ($id_tarif) {
                $q->where('id_tarif', $id_tarif);
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $semua_tagihan = $query->paginate(10);

        // Ambil semua data tarif untuk dropdown
        $semua_tarif = Tarif::all();

        return view('admin.tagihan.index', compact('semua_tagihan', 'semua_tarif'));
    }

    /**
     * Membuat tagihan baru berdasarkan data penggunaan.
     */
    public function generate(Penggunaan $penggunaan)
    {
        $existingTagihan = Tagihan::where('id_penggunaan', $penggunaan->id_penggunaan)->first();

        if ($existingTagihan) {
            return redirect()->route('admin.penggunaan.index')->with('error', 'Tagihan untuk penggunaan ini sudah pernah dibuat.');
        }

        $jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;
        $tarif_per_kwh = $penggunaan->pelanggan->tarif->tarif_per_kwh;
        $total_bayar = $jumlah_meter * $tarif_per_kwh;

        Tagihan::create([
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'jumlah_meter' => $jumlah_meter,
            'total_bayar' => $total_bayar,
            'status' => 'Belum Lunas',
        ]);

        return redirect()->route('admin.penggunaan.index')->with('success', 'Tagihan berhasil dibuat.');
    }
}
