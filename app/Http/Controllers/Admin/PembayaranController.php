<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    /**
     * Menampilkan halaman form verifikasi pembayaran.
     */
    public function create(Tagihan $tagihan)
    {
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

        $tagihan = Tagihan::findOrFail($request->id_tagihan);

        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'biaya_admin' => $request->biaya_admin,
            'total_akhir' => $tagihan->total_bayar + $request->biaya_admin,
        ]);

        $tagihan->update(['status' => 'Lunas']);

        return redirect()->route('admin.tagihan.index')
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    /**
     * Menampilkan detail/struk pembayaran.
     */
    public function show(Tagihan $tagihan)
    {
        // Pastikan tagihan sudah lunas untuk bisa dilihat struknya
        if ($tagihan->status !== 'Lunas' || !$tagihan->pembayaran) {
            abort(404); // Tampilkan halaman not found jika tagihan belum lunas
        }

        // Muat semua relasi yang dibutuhkan
        $tagihan->load('penggunaan.pelanggan.tarif', 'pembayaran');

        return view('admin.pembayaran.show', compact('tagihan'));
    }
}
