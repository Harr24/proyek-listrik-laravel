<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data penggunaan beserta relasi ke pelanggan
        $semua_penggunaan = Penggunaan::with('pelanggan')->get();

        return view('admin.penggunaan.index', compact('semua_penggunaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semua_pelanggan = Pelanggan::all();
        return view('admin.penggunaan.create', compact('semua_pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric',
            'meter_awal' => 'required|numeric|min:0',
            'meter_akhir' => 'required|numeric|gte:meter_awal', // meter akhir harus lebih besar atau sama dengan meter awal
        ]);

        Penggunaan::create($request->all());

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Data penggunaan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penggunaan $penggunaan)
    {
        $semua_pelanggan = Pelanggan::all();
        return view('admin.penggunaan.edit', compact('penggunaan', 'semua_pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penggunaan $penggunaan)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric',
            'meter_awal' => 'required|numeric|min:0',
            'meter_akhir' => 'required|numeric|gte:meter_awal',
        ]);

        $penggunaan->update($request->all());

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Data penggunaan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penggunaan $penggunaan)
    {
        $penggunaan->delete();

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Data penggunaan berhasil dihapus.');
    }
}
