@extends('layouts.pelanggan')

@section('title', 'Pusat Bantuan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Riwayat Keluhan Anda</h3>
                <a href="{{ route('pelanggan.keluhan.create') }}" class="btn btn-primary">Buat Tiket Baru</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Judul Keluhan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semua_keluhan as $keluhan)
                                    <tr>
                                        <td>{{ $keluhan->created_at->format('d F Y') }}</td>
                                        <td>{{ $keluhan->judul }}</td>
                                        <td>
                                            @if($keluhan->status == 'Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif($keluhan->status == 'Ditangani')
                                                <span class="badge bg-warning">Sedang Ditangani</span>
                                            @else
                                                <span class="badge bg-secondary">Dibuka</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pelanggan.keluhan.show', $keluhan) }}"
                                                class="btn btn-info btn-sm">Lihat Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Anda belum pernah membuat keluhan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $semua_keluhan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection