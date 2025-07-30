@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Konfirmasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Petunjuk Pembayaran</h5>
                        <p>Silakan lakukan transfer ke nomor Virtual Account di bawah ini:</p>
                        <p class="fs-4 fw-bold mb-1">BCA Virtual Account: 081326740142</p>
                        <p>Atas Nama: Admin Listrik Pascabayar</p>
                        <hr>
                        <p><strong>Total yang harus dibayar (termasuk biaya admin Rp 2.500):</strong></p>
                        <p class="fs-3 fw-bold">Rp {{ number_format($tagihan->total_bayar + 2500, 0, ',', '.') }}</p>
                        <hr>
                        <p class="mb-0">Setelah melakukan transfer, silakan unggah bukti pembayaran Anda pada form di bawah
                            ini.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pelanggan.pembayaran.store') }}" method="POST" enctype="multipart/form-data"
                        class="mt-4">
                        @csrf
                        <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">

                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Unggah Bukti Pembayaran</label>
                            <input class="form-control" type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                            <div class="form-text">Format file: JPG, PNG, JPEG. Ukuran maksimal: 2MB.</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran Saya</button>
                        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection