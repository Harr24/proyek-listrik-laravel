@extends('layouts.pelanggan')

@section('title', 'Detail Keluhan')

@push('styles')
    <style>
        .chat-bubble {
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            max-width: 80%;
        }

        .chat-bubble-admin {
            background-color: #e9ecef;
            align-self: flex-start;
        }

        .chat-bubble-pelanggan {
            background-color: #d1e7dd;
            align-self: flex-end;
        }

        .chat-container {
            display: flex;
            flex-direction: column;
        }

        .chat-meta {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .chat-bubble img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Detail Keluhan #{{ $keluhan->id }}</h3>
                <a href="{{ route('pelanggan.keluhan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-0">{{ $keluhan->judul }}</h5>
                        <div>
                            @if($keluhan->status == 'Selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($keluhan->status == 'Ditangani')
                                <span class="badge bg-warning">Sedang Ditangani</span>
                            @else
                                <span class="badge bg-secondary">Dibuka</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <p><strong>Keluhan Awal:</strong></p>
                    <p>{{ $keluhan->deskripsi }}</p>
                    <hr>

                    {{-- Area Chat --}}
                    <div class="chat-container">
                        @forelse ($keluhan->balasan as $balasan)
                            <div
                                class="chat-bubble {{ $balasan->user->role == 'admin' ? 'chat-bubble-admin' : 'chat-bubble-pelanggan' }}">
                                <p class="mb-0">{{ $balasan->pesan }}</p>
                                @if ($balasan->gambar)
                                    <a href="{{ asset('storage/keluhan/' . $balasan->gambar) }}" target="_blank">
                                        <img src="{{ asset('storage/keluhan/' . $balasan->gambar) }}" alt="Lampiran">
                                    </a>
                                @endif
                                <div class="chat-meta mt-2 text-end">
                                    <strong>{{ $balasan->user->name }}</strong> -
                                    {{ $balasan->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Belum ada balasan. Admin akan segera merespons keluhan Anda.</p>
                        @endforelse
                    </div>

                    {{-- Form Balasan --}}
                    @if ($keluhan->status != 'Selesai')
                        <hr>
                        <div class="mt-4">
                            <h5>Kirim Balasan</h5>
                            {{-- PERBAIKAN DI SINI: action form diubah ke rute yang benar --}}
                            <form action="{{ route('pelanggan.keluhan.balas', $keluhan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <textarea class="form-control" name="pesan" rows="4" placeholder="Tulis balasan Anda..."
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Lampirkan Gambar (Opsional)</label>
                                    <input class="form-control" type="file" name="gambar" id="gambar">
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection