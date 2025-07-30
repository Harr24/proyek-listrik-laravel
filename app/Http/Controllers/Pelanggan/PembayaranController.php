<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Menampilkan halaman untuk melakukan pembayaran.
     */
    public function create(Tagihan $tagihan)
    {
        // Keamanan: Pastikan tagihan ini milik user yang sedang login
        $idPelangganLogin = Auth::user()->pelanggan->id_pelanggan;
        if ($tagihan->penggunaan->id_pelanggan != $idPelangganLogin) {
            abort(403);
        }

        return view('pelanggan.pembayaran.create', compact('tagihan'));
    }

    /**
     * Menyimpan bukti pembayaran dan mengubah status tagihan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tagihan' => 'required|exists:tagihans,id_tagihan',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        $tagihan = Tagihan::findOrFail($request->id_tagihan);

        // Keamanan: Cek lagi kepemilikan tagihan
        $idPelangganLogin = Auth::user()->pelanggan->id_pelanggan;
        if ($tagihan->penggunaan->id_pelanggan != $idPelangganLogin) {
            abort(403);
        }

        // Proses upload file
        $fileName = time() . '.' . $request->bukti_pembayaran->extension();
        $request->bukti_pembayaran->storeAs('public/bukti_pembayaran', $fileName);

        // Buat data pembayaran
        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'tanggal_bayar' => now(),
            'biaya_admin' => 2500, // Default
            'total_akhir' => $tagihan->total_bayar + 2500,
            'bukti_pembayaran' => $fileName,
        ]);

        // Update status tagihan
        $tagihan->update(['status' => 'Menunggu Konfirmasi']);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu konfirmasi dari admin.');
    }
}
