<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class PembayaranController extends Controller
{
    public function konfirmasiIndex()
    {
        $semua_tagihan = Tagihan::where('status', 'Menunggu Konfirmasi')
            ->with('penggunaan.pelanggan', 'pembayaran')
            ->get();

        return view('admin.pembayaran.konfirmasi', compact('semua_tagihan'));
    }

    // TAMBAHAN BARU: Method untuk menampilkan detail konfirmasi
    public function konfirmasiShow(Tagihan $tagihan)
    {
        $tagihan->load('penggunaan.pelanggan', 'pembayaran');
        return view('admin.pembayaran.konfirmasi_show', compact('tagihan'));
    }

    // TAMBAHAN BARU: Method untuk menyetujui pembayaran
    public function konfirmasiApprove(Tagihan $tagihan)
    {
        $tagihan->update(['status' => 'Lunas']);
        return redirect()->route('admin.pembayaran.konfirmasi.index')->with('success', 'Pembayaran berhasil disetujui.');
    }

    // TAMBAHAN BARU: Method untuk menolak pembayaran
    public function konfirmasiReject(Tagihan $tagihan)
    {
        // Hapus file bukti pembayaran dari storage
        if ($tagihan->pembayaran && $tagihan->pembayaran->bukti_pembayaran) {
            Storage::delete('public/bukti_pembayaran/' . $tagihan->pembayaran->bukti_pembayaran);
        }

        // Hapus data pembayaran
        $tagihan->pembayaran->delete();
        // Kembalikan status tagihan
        $tagihan->update(['status' => 'Belum Lunas']);

        return redirect()->route('admin.pembayaran.konfirmasi.index')->with('success', 'Pembayaran berhasil ditolak.');
    }

    public function create(Tagihan $tagihan)
    {
        $tagihan->load('penggunaan.pelanggan.tarif');

        return view('admin.pembayaran.create', compact('tagihan'));
    }

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

    public function show(Tagihan $tagihan)
    {
        if ($tagihan->status !== 'Lunas' || !$tagihan->pembayaran) {
            abort(404);
        }

        $tagihan->load('penggunaan.pelanggan.tarif', 'pembayaran');

        return view('admin.pembayaran.show', compact('tagihan'));
    }
}
