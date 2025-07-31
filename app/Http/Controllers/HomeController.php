<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage).
     */
    public function index()
    {
        // hanya menampilkan view, tanpa data
        return view('home');
    }

    /**
     * Menampilkan halaman daftar harga.
     */
    public function daftarHarga()
    {
        // Ambil semua data dari tabel tarifs
        $semua_tarif = Tarif::all();

        // Kirim data tersebut ke view 'daftar-harga'
        return view('daftar-harga', compact('semua_tarif'));
    }
}
