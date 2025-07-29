@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Dashboard Pelanggan</h4>
                </div>
                <div class="card-body">
                    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p>Di bawah ini adalah riwayat tagihan listrik Anda.</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Tagihan Anda</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Jumlah Meter</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semua_tagihan as $tagihan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tagihan->penggunaan->bulan }} {{ $tagihan->penggunaan->tahun }}</td>
                                        <td>{{ $tagihan->jumlah_meter }} KWH</td>
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
                                        <td colspan="5" class="text-center">Anda belum memiliki riwayat tagihan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection