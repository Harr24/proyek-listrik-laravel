@extends('layouts.admin')

@section('title', 'Kelola Keluhan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Keluhan Pelanggan</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Judul Keluhan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_keluhan as $keluhan)
                            <tr>
                                <td>{{ $semua_keluhan->firstItem() + $loop->index }}</td>
                                <td>{{ $keluhan->user->name }}</td>
                                <td>{{ Str::limit($keluhan->judul, 50) }}</td>
                                <td>{{ $keluhan->created_at->format('d F Y') }}</td>
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
                                    <a href="{{ route('admin.keluhan.show', $keluhan) }}" class="btn btn-info btn-sm">Lihat
                                        Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada keluhan yang masuk.</td>
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
@endsection