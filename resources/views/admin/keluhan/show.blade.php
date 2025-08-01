@extends('layouts.admin')

@section('title', 'Detail Keluhan')

@push('styles')
    <style>
        .chat-container {
            display: flex;
            flex-direction: column;
            max-height: 400px;
            /* Batas tinggi area chat */
            overflow-y: auto;
            /* Aktifkan scroll jika chat panjang */
            padding: 10px;
        }

        .chat-bubble {
            padding: 10px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            max-width: 80%;
            line-height: 1.4;
        }

        .chat-bubble-admin {
            background-color: #e9ecef;
            align-self: flex-start;
            /* Balasan admin di kiri */
        }

        .chat-bubble-pelanggan {
            background-color: #d1e7dd;
            align-self: flex-end;
            /* Pesan pelanggan di kanan */
        }

        .chat-meta {
            font-size: 0.75rem;
            color: #6c757d;
        }

        /* PERBAIKAN: Style untuk gambar agar tidak besar */
        .chat-bubble img,
        .proof-image {
            max-width: 200px;
            /* Batasi lebar gambar */
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .chat-bubble img:hover,
        .proof-image:hover {
            transform: scale(1.05);
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Keluhan #{{ $keluhan->id }}</h1>
        <a href="{{ route('admin.keluhan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="row">
        {{-- Kolom Kiri: Detail dan Chat --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $keluhan->judul }}</h5>
                    <div>
                        @if($keluhan->status == 'Selesai') <span class="badge bg-success">Selesai</span>
                        @elseif($keluhan->status == 'Ditangani') <span class="badge bg-warning">Sedang Ditangani</span>
                        @else <span class="badge bg-secondary">Dibuka</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <p><strong>Dikirim oleh:</strong> {{ $keluhan->user->name }}</p>
                    <p><strong>Keluhan Awal:</strong></p>
                    <p class="fst-italic">"{{ $keluhan->deskripsi }}"</p>
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
                            <p class="text-center text-muted">Belum ada balasan. Silakan kirim balasan pertama.</p>
                        @endforelse
                    </div>

                    {{-- Form Balasan --}}
                    @if ($keluhan->status != 'Selesai')
                        <hr>
                        <div class="mt-4">
                            <h5>Kirim Balasan</h5>
                            <form action="{{ route('admin.keluhan.balas', $keluhan) }}" method="POST"
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
                                <button type="submit" class="btn btn-primary">Kirim Balasan</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- Kolom Kanan: Aksi --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Ubah Status</div>
                <div class="card-body">
                    <form action="{{ route('admin.keluhan.status', $keluhan) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                <option value="Ditangani" @if($keluhan->status == 'Ditangani') selected @endif>Sedang
                                    Ditangani</option>
                                <option value="Selesai" @if($keluhan->status == 'Selesai') selected @endif>Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection