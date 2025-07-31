<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $semua_berita = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('semua_berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
        ]);

        $path = $request->file('gambar')->store('public/berita');

        Berita::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => basename($path),
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
        ]);

        $path = $berita->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete('public/berita/' . $berita->gambar);
            // Simpan gambar baru
            $newPath = $request->file('gambar')->store('public/berita');
            $path = basename($newPath);
        }

        $berita->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diubah.');
    }

    public function destroy(Berita $berita)
    {
        // Hapus gambar dari storage
        Storage::delete('public/berita/' . $berita->gambar);
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
