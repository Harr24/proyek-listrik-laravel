<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KeluhanController extends Controller
{
    /**
     * Menampilkan daftar semua keluhan.
     */
    public function index()
    {
        $semua_keluhan = Keluhan::with('user')->latest()->paginate(10);
        return view('admin.keluhan.index', compact('semua_keluhan'));
    }

    /**
     * Menampilkan detail satu keluhan (chat).
     */
    public function show(Keluhan $keluhan)
    {
        $keluhan->load('balasan.user');
        return view('admin.keluhan.show', compact('keluhan'));
    }

    /**
     * Menyimpan balasan dari admin.
     */
    public function storeBalasan(Request $request, Keluhan $keluhan)
    {
        $request->validate([
            'pesan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/keluhan');
        }

        $keluhan->balasan()->create([
            'user_id' => Auth::id(), // ID admin yang sedang login
            'pesan' => $request->pesan,
            'gambar' => $path ? basename($path) : null,
        ]);

        // Otomatis ubah status menjadi "Ditangani" saat admin membalas
        if ($keluhan->status == 'Dibuka') {
            $keluhan->update(['status' => 'Ditangani']);
        }

        return redirect()->route('admin.keluhan.show', $keluhan)->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * Mengubah status keluhan.
     */
    public function updateStatus(Request $request, Keluhan $keluhan)
    {
        $request->validate([
            'status' => 'required|in:Ditangani,Selesai',
        ]);

        $keluhan->update(['status' => $request->status]);

        return redirect()->route('admin.keluhan.show', $keluhan)->with('success', 'Status keluhan berhasil diubah.');
    }
}
