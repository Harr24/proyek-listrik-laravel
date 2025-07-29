<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tarif;
use App\Models\User; // <-- TAMBAHAN BARU
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- TAMBAHAN BARU

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
        // PERUBAHAN DI SINI: Validasi untuk data user dan pelanggan
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_meter' => 'required|string|unique:pelanggans,nomor_meter',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarifs,id_tarif',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // PERUBAHAN DI SINI: Buat user baru terlebih dahulu
        $user = User::create([
            'name' => $request->nama_pelanggan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);

        // PERUBAHAN DI SINI: Buat data pelanggan dan hubungkan dengan user_id
        Pelanggan::create([
            'user_id' => $user->id, // <-- Ini jembatannya
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_meter' => $request->nomor_meter,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
        ]);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan baru berhasil ditambahkan.');
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
        // Hapus user terkait terlebih dahulu jika ada
        if ($pelanggan->user) {
            $pelanggan->user->delete();
        }

        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
