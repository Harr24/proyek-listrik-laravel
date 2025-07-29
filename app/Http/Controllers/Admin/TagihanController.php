<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Penggunaan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Menampilkan daftar semua tagihan.
     */
    public function index(Request $request) // PERUBAHAN DI SINI
    {
        // LOGIKA BARU UNTUK PENCARIAN
        $query = Tagihan::with('penggunaan.pelanggan');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            // Mencari di tabel tagihan (status)
            $query->where('status', 'like', '%' . $search . '%')
                // Mencari di tabel penggunaan yang terhubung
                ->orWhereHas('penggunaan', function ($q) use ($search) {
                    $q->where('bulan', 'like', '%' . $search . '%')
                        ->orWhere('tahun', 'like', '%' . $search . '%')
                        // Mencari di tabel pelanggan yang terhubung
                        ->orWhereHas('pelanggan', function ($subq) use ($search) {
                            $subq->where('nama_pelanggan', 'like', '%' . $search . '%')
                                ->orWhere('nomor_meter', 'like', '%' . $search . '%');
                        });
                });
        }

        $semua_tagihan = $query->get();
        // AKHIR DARI LOGIKA BARU

        return view('admin.tagihan.index', compact('semua_tagihan'));
    }

    /**
     * Membuat tagihan baru berdasarkan data penggunaan.
     */
    public function generate(Penggunaan $penggunaan)
    {
        // Cek apakah tagihan untuk penggunaan ini sudah ada
        $existingTagihan = Tagihan::where('id_penggunaan', $penggunaan->id_penggunaan)->first();

        if ($existingTagihan) {
            return redirect()->route('admin.penggunaan.index')->with('error', 'Tagihan untuk penggunaan ini sudah pernah dibuat.');
        }

        // 1. Hitung jumlah meter yang digunakan
        $jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;

        // 2. Ambil tarif per KWH dari data pelanggan yang terkait
        $tarif_per_kwh = $penggunaan->pelanggan->tarif->tarif_per_kwh;

        // 3. Hitung total bayar
        $total_bayar = $jumlah_meter * $tarif_per_kwh;

        // 4. Buat tagihan baru
        Tagihan::create([
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'jumlah_meter' => $jumlah_meter,
            'total_bayar' => $total_bayar,
            'status' => 'Belum Lunas',
        ]);

        return redirect()->route('admin.penggunaan.index')->with('success', 'Tagihan berhasil dibuat.');
    }
}
