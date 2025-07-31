@extends('layouts.admin')

@section('title', 'Kelola Data Tagihan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Data Tagihan</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- FORM FILTER BARU --}}
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('admin.tagihan.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="search_nama" class="form-label">Cari Nama Pelanggan</label>
                        <input type="text" class="form-control" id="search_nama" name="search_nama"
                            value="{{ request('search_nama') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select">
                            <option value="">Semua</option>
                            <option value="Januari" @if(request('bulan') == 'Januari') selected @endif>Januari</option>
                            <option value="Februari" @if(request('bulan') == 'Februari') selected @endif>Februari</option>
                            <option value="Maret" @if(request('bulan') == 'Maret') selected @endif>Maret</option>
                            <option value="April" @if(request('bulan') == 'April') selected @endif>April</option>
                            <option value="Mei" @if(request('bulan') == 'Mei') selected @endif>Mei</option>
                            <option value="Juni" @if(request('bulan') == 'Juni') selected @endif>Juni</option>
                            <option value="Juli" @if(request('bulan') == 'Juli') selected @endif>Juli</option>
                            <option value="Agustus" @if(request('bulan') == 'Agustus') selected @endif>Agustus</option>
                            <option value="September" @if(request('bulan') == 'September') selected @endif>September</option>
                            <option value="Oktober" @if(request('bulan') == 'Oktober') selected @endif>Oktober</option>
                            <option value="November" @if(request('bulan') == 'November') selected @endif>November</option>
                            <option value="Desember" @if(request('bulan') == 'Desember') selected @endif>Desember</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" value="{{ request('tahun') }}"
                            placeholder="Contoh: 2024">
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="Belum Lunas" @if(request('status') == 'Belum Lunas') selected @endif>Belum Lunas
                            </option>
                            <option value="Menunggu Konfirmasi" @if(request('status') == 'Menunggu Konfirmasi') selected
                            @endif>Menunggu Konfirmasi</option>
                            <option value="Lunas" @if(request('status') == 'Lunas') selected @endif>Lunas</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- AKHIR FORM FILTER --}}

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semua_tagihan as $tagihan)
                    <tr>
                        <td>{{ $semua_tagihan->firstItem() + $loop->index }}</td>
                        <td>{{ $tagihan->penggunaan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                        <td>{{ $tagihan->penggunaan->bulan ?? 'N/A' }} {{ $tagihan->penggunaan->tahun ?? '' }}</td>
                        <td>Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</td>
                        <td>
                            @if($tagihan->status == 'Lunas')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($tagihan->status == 'Menunggu Konfirmasi')
                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                            @else
                                <span class="badge bg-danger">Belum Lunas</span>
                            @endif
                        </td>
                        <td>
                            @if($tagihan->status == 'Lunas')
                                <a href="{{ route('admin.pembayaran.show', $tagihan) }}" class="btn btn-secondary btn-sm">Lihat
                                    Detail</a>
                            @elseif($tagihan->status == 'Menunggu Konfirmasi')
                                <a href="{{ route('admin.pembayaran.konfirmasi.show', $tagihan) }}"
                                    class="btn btn-primary btn-sm">Proses</a>
                            @else
                                <a href="{{ route('admin.pembayaran.create', $tagihan) }}" class="btn btn-info btn-sm">Verifikasi
                                    Manual</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $semua_tagihan->appends(request()->query())->links() }}
    </div>

@endsection