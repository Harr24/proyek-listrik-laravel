<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenggunaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penggunaan::with(['pelanggan', 'tagihan']);

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('bulan', 'like', '%' . $search . '%')
                ->orWhere('tahun', 'like', '%' . $search . '%')
                ->orWhereHas('pelanggan', function ($q) use ($search) {
                    $q->where('nama_pelanggan', 'like', '%' . $search . '%')
                        ->orWhere('nomor_meter', 'like', '%' . $search . '%');
                });
        }

        $semua_penggunaan = $query->paginate(10);

        // Logika untuk daftar tugas sudah dipindahkan
        return view('admin.penggunaan.index', compact('semua_penggunaan'));
    }

    // Method baru khusus untuk halaman "Belum Diinput"
    public function belumInputIndex(Request $request)
    {
        $daftarBulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        // Ambil filter dari request, jika tidak ada, gunakan bulan & tahun saat ini
        $bulanInggris = Carbon::now()->format('F');
        $bulanIni = $request->input('bulan', $daftarBulan[$bulanInggris]);
        $tahunIni = $request->input('tahun', Carbon::now()->year);

        $sudahDiinputIds = Penggunaan::where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->pluck('id_pelanggan');

        $pelanggan_belum_input = Pelanggan::whereNotIn('id_pelanggan', $sudahDiinputIds)->get();

        return view('admin.penggunaan.belum_input', compact('pelanggan_belum_input', 'bulanIni', 'tahunIni'));
    }

    public function create(Request $request)
    {
        $semua_pelanggan = Pelanggan::all();
        $pelanggan_id_terpilih = $request->query('pelanggan_id');

        return view('admin.penggunaan.create', compact('semua_pelanggan', 'pelanggan_id_terpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric',
            'meter_awal' => 'required|numeric|min:0',
            'meter_akhir' => 'required|numeric|gte:meter_awal',
        ]);

        Penggunaan::create($request->all());

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Data penggunaan berhasil ditambahkan.');
    }

    public function edit(Penggunaan $penggunaan)
    {
        $semua_pelanggan = Pelanggan::all();
        return view('admin.penggunaan.edit', compact('penggunaan', 'semua_pelanggan'));
    }

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

    public function destroy(Penggunaan $penggunaan)
    {
        $penggunaan->delete();

        return redirect()->route('admin.penggunaan.index')
            ->with('success', 'Data penggunaan berhasil dihapus.');
    }
}
