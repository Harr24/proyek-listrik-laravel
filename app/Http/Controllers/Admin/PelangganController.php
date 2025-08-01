<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan.
     */
    public function index(Request $request)
    {
        $query = Pelanggan::with('tarif');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('nama_pelanggan', 'like', '%' . $search . '%')
                ->orWhere('nomor_meter', 'like', '%' . $search . '%');
        }

        $semua_pelanggan = $query->paginate(10);

        return view('admin.pelanggan.index', ['semua_pelanggan' => $semua_pelanggan]);
    }

    /**
     * Menampilkan form untuk membuat pelanggan baru.
     */
    public function create()
    {
        $semua_tarif = Tarif::all();
        return view('admin.pelanggan.create', ['semua_tarif' => $semua_tarif]);
    }

    /**
     * Menyimpan pelanggan baru ke database.
     */
    public function store(Request $request)
    {
        // PERBAIKAN VALIDASI DI SINI
        $request->validate([
            // Mengganti alpha_spaces dengan regex untuk huruf dan spasi
            'nama_pelanggan' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255|unique:pelanggans,nama_pelanggan',
            'nomor_meter' => 'required|numeric|digits_between:11,12|unique:pelanggans,nomor_meter',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarifs,id_tarif',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->nama_pelanggan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'user_id' => $user->id,
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
        // PERBAIKAN VALIDASI DI SINI
        $request->validate([
            'id_tarif' => 'required|exists:tarifs,id_tarif',
            'nomor_meter' => 'required|numeric|digits_between:11,12|unique:pelanggans,nomor_meter,' . $pelanggan->id_pelanggan . ',id_pelanggan',
            // Mengganti alpha_spaces dengan regex untuk huruf dan spasi
            'nama_pelanggan' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255|unique:pelanggans,nama_pelanggan,' . $pelanggan->id_pelanggan . ',id_pelanggan',
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
        if ($pelanggan->user) {
            $pelanggan->user->delete();
        }

        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
