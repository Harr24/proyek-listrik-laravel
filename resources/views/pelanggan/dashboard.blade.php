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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p>Di bawah ini adalah riwayat tagihan dan grafik penggunaan listrik Anda.</p>
                </div>
            </div>

            {{-- PERUBAHAN POSISI: Tabel Riwayat Tagihan sekarang di atas --}}
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
                                    <th>Aksi</th>
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
                                            @elseif($tagihan->status == 'Menunggu Konfirmasi')
                                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                            @else
                                                <span class="badge bg-danger">Belum Lunas</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($tagihan->status == 'Belum Lunas')
                                                <a href="{{ route('pelanggan.pembayaran.create', $tagihan) }}"
                                                    class="btn btn-primary btn-sm">Bayar Sekarang</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Anda belum memiliki riwayat tagihan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- PERUBAHAN POSISI: Grafik sekarang di bawah --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Grafik Penggunaan Listrik (12 Bulan Terakhir)</h5>
                </div>
                <div class="card-body">
                    <canvas id="usageChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('usageChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Pemakaian Listrik (KWH)',
                        data: @json($chartData),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endsection