<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Carbon\Carbon; // <-- Penting untuk mengelola tanggal

class PembayaranController extends Controller
{
    /**
     * Menampilkan halaman form verifikasi pembayaran.
     */
    public function create(Tagihan $tagihan)
    {
        // Muat relasi untuk memastikan data tersedia di view
        $tagihan->load('penggunaan.pelanggan.tarif');

        return view('admin.pembayaran.create', compact('tagihan'));
    }

    /**
     * Menyimpan data pembayaran dan mengubah status tagihan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tagihan' => 'required|exists:tagihans,id_tagihan',
            'tanggal_bayar' => 'required|date',
            'biaya_admin' => 'required|numeric|min:0',
        ]);

        // 1. Cari tagihan berdasarkan ID
        $tagihan = Tagihan::findOrFail($request->id_tagihan);

        // 2. Buat data pembayaran baru
        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'biaya_admin' => $request->biaya_admin,
            'total_akhir' => $tagihan->total_bayar + $request->biaya_admin,
        ]);

        // 3. Update status tagihan menjadi 'Lunas'
        $tagihan->update(['status' => 'Lunas']);

        return redirect()->route('admin.tagihan.index')
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }
}
