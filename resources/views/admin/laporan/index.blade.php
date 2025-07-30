@extends('layouts.admin')

@section('title', 'Laporan Tagihan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Tagihan</h1>
    </div>

    <div class="card mb-4 no-print">
        <div class="card-header">
            Filter Laporan
        </div>
        <div class="card-body">
            <form action="{{ route('admin.laporan.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select">
                            <option value="">Semua Bulan</option>
                            <option value="Januari" @if($bulan == 'Januari') selected @endif>Januari</option>
                            <option value="Februari" @if($bulan == 'Februari') selected @endif>Februari</option>
                            <option value="Maret" @if($bulan == 'Maret') selected @endif>Maret</option>
                            <option value="April" @if($bulan == 'April') selected @endif>April</option>
                            <option value="Mei" @if($bulan == 'Mei') selected @endif>Mei</option>
                            <option value="Juni" @if($bulan == 'Juni') selected @endif>Juni</option>
                            <option value="Juli" @if($bulan == 'Juli') selected @endif>Juli</option>
                            <option value="Agustus" @if($bulan == 'Agustus') selected @endif>Agustus</option>
                            <option value="September" @if($bulan == 'September') selected @endif>September</option>
                            <option value="Oktober" @if($bulan == 'Oktober') selected @endif>Oktober</option>
                            <option value="November" @if($bulan == 'November') selected @endif>November</option>
                            <option value="Desember" @if($bulan == 'Desember') selected @endif>Desember</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Contoh: 2024"
                            value="{{ $tahun }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            Hasil Laporan
            <div class="no-print">
                {{-- Tombol Cetak Laporan sudah dihapus --}}
                <a href="{{ route('admin.laporan.export', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                    class="btn btn-success btn-sm">Export ke Excel</a>
            </div>
        </div>
        <div class="card-body">
            <p><strong>Total Pendapatan (Lunas):</strong> <span class="fs-5 fw-bold">Rp
                    {{ number_format($total_pendapatan, 0, ',', '.') }}</span></p>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Periode</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_tagihan as $tagihan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tagihan->penggunaan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                                <td>{{ $tagihan->penggunaan->bulan ?? 'N/A' }} {{ $tagihan->penggunaan->tahun ?? '' }}</td>
                                <td>Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</td>
                                <td>
                                    @if($tagihan->status == 'Lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-danger">Belum Lunas</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data tagihan untuk periode yang dipilih.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection