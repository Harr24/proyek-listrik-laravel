<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Menampilkan daftar semua tarif.
     */
    public function index()
    {
        $data_tarif = Tarif::all();
        return view('admin.tarif.index', ['semua_tarif' => $data_tarif]);
    }

    /**
     * Menampilkan form untuk membuat tarif baru.
     */
    public function create()
    {
        return view('admin.tarif.create');
    }

    /**
     * Menyimpan tarif baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'daya' => 'required|string|max:50',
            'tarif_per_kwh' => 'required|integer|min:0',
        ]);

        Tarif::create([
            'daya' => $request->daya,
            'tarif_per_kwh' => $request->tarif_per_kwh,
        ]);

        return redirect()->route('admin.tarif.index')->with('success', 'Data tarif berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit tarif.
     */
    public function edit(Tarif $tarif)
    {
        return view('admin.tarif.edit', ['tarif' => $tarif]);
    }

    /**
     * Mengupdate data tarif di database.
     */
    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'daya' => 'required|string|max:50',
            'tarif_per_kwh' => 'required|integer|min:0',
        ]);

        $tarif->update([
            'daya' => $request->daya,
            'tarif_per_kwh' => $request->tarif_per_kwh,
        ]);

        return redirect()->route('admin.tarif.index')->with('success', 'Data tarif berhasil diubah.');
    }

    /**
     * Menghapus data tarif dari database.
     */
    public function destroy(Tarif $tarif)
    {
        // Hapus data dari database
        $tarif->delete();

        // Kembali ke halaman daftar tarif dengan pesan sukses
        return redirect()->route('admin.tarif.index')->with('success', 'Data tarif berhasil dihapus.');
    }
}