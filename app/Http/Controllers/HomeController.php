<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;
use App\Models\Pelanggan;
use App\Models\Berita;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage).
     */
    public function index()
    {
        $jumlah_pelanggan = Pelanggan::count();
        // Mengambil 10 berita terbaru untuk ditampilkan di carousel
        $berita_terbaru = Berita::latest()->take(10)->get();

        return view('home', compact('jumlah_pelanggan', 'berita_terbaru'));
    }

    /**
     * Menampilkan halaman daftar harga.
     */
    public function daftarHarga()
    {
        $semua_tarif = Tarif::all();
        return view('daftar-harga', compact('semua_tarif'));
    }
}
