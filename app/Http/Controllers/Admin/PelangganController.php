<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tarif; // <-- Penting untuk mengambil data tarif
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan.
     */
    public function index()
    {
        // Ambil data pelanggan beserta data tarif yang terhubung
        $data_pelanggan = Pelanggan::with('tarif')->get();

        return view('admin.pelanggan.index', ['semua_pelanggan' => $data_pelanggan]);
    }

    /**
     * Menampilkan form untuk membuat pelanggan baru.
     */
    public function create()
    {
        // Ambil semua data tarif untuk ditampilkan di dropdown
        $semua_tarif = Tarif::all();
        return view('admin.pelanggan.create', ['semua_tarif' => $semua_tarif]);
    }

    /**
     * Menyimpan pelanggan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tarif' => 'required|exists:tarifs,id_tarif',
            'nomor_meter' => 'required|string|unique:pelanggans,nomor_meter',
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data pelanggan.
     */
    public function edit(Pelanggan $pelanggan)
    {
        $semua_tarif = Tarif::all();
        return view('admin.pelanggan.edit', [
            'pelanggan' => $pelanggan,
            'semua_tarif' => $semua_tarif
        ]);
    }

    /**
     * Mengupdate data pelanggan di database.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'id_tarif' => 'required|exists:tarifs,id_tarif',
            'nomor_meter' => 'required|string|unique:pelanggans,nomor_meter,' . $pelanggan->id_pelanggan . ',id_pelanggan',
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diubah.');
    }

    /**
     * Menghapus data pelanggan dari database.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
