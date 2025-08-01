<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\BalasanKeluhan; // <-- Pastikan ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{
    /**
     * Menampilkan daftar keluhan milik user.
     */
    public function index()
    {
        $semua_keluhan = Auth::user()->keluhan()->latest()->paginate(10);
        return view('pelanggan.keluhan.index', compact('semua_keluhan'));
    }

    /**
     * Menampilkan form untuk membuat keluhan baru.
     */
    public function create()
    {
        return view('pelanggan.keluhan.create');
    }

    /**
     * Menyimpan keluhan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $keluhan = new Keluhan([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Dibuka',
        ]);

        Auth::user()->keluhan()->save($keluhan);

        return redirect()->route('pelanggan.keluhan.index')->with('success', 'Keluhan Anda berhasil dikirim.');
    }

    /**
     * Menampilkan detail satu keluhan (chat).
     */
    public function show(Keluhan $keluhan)
    {
        // Keamanan: Pastikan user hanya bisa melihat keluhannya sendiri
        if ($keluhan->user_id !== Auth::id()) {
            abort(403);
        }

        $keluhan->load('balasan.user'); // Ambil data balasan beserta user pengirimnya

        return view('pelanggan.keluhan.show', compact('keluhan'));
    }

    // TAMBAHAN BARU: Method untuk menyimpan balasan dari pelanggan
    public function storeBalasan(Request $request, Keluhan $keluhan)
    {
        // Keamanan: Pastikan user hanya bisa membalas keluhannya sendiri
        if ($keluhan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'pesan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/keluhan');
        }

        $keluhan->balasan()->create([
            'user_id' => Auth::id(),
            'pesan' => $request->pesan,
            'gambar' => $path ? basename($path) : null,
        ]);

        return redirect()->route('pelanggan.keluhan.show', $keluhan)->with('success', 'Balasan berhasil dikirim.');
    }
}
