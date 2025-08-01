@extends('layouts.pelanggan')

@section('title', 'Struk Pembayaran')

@push('styles')
    <style>
        .receipt-container {
            max-width: 480px;
            margin: 20px auto;
            background: white;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: .375rem;
        }

        .receipt-header {
            background-color: #0d6efd;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top-left-radius: .375rem;
            border-top-right-radius: .375rem;
        }

        .receipt-body {
            padding: 2rem;
        }

        .receipt-body h5 {
            font-weight: bold;
            margin-top: 1rem;
        }

        .receipt-body p {
            margin-bottom: 5px;
            color: #6c757d;
        }

        .receipt-body p strong {
            color: #212529;
        }

        .receipt-footer {
            padding: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: #6c757d;
            background-color: #f8f9fa;
            border-bottom-left-radius: .375rem;
            border-bottom-right-radius: .375rem;
        }

        .line-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        hr.dashed {
            border-top: 1px dashed #adb5bd;
        }

        .no-print {
            text-align: center;
            padding: 20px 0;
        }

        @media print {
            body {
                background-color: white !important;
            }

            .no-print,
            .navbar {
                display: none !important;
            }

            main.py-4 {
                padding: 0 !important;
            }

            .receipt-container {
                margin: 0;
                box-shadow: none;
                border: none;
                max-width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="receipt-container">
        <div class="receipt-header">
            <h3 class="mb-1">STRUK PEMBAYARAN LISTRIK</h3>
            <p class="mb-0">PT HARRYCAHAYARUMAH</p>
        </div>
        <div class="receipt-body">
            <h5>Detail Pelanggan</h5>
            <p><strong>Nama:</strong> {{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</p>
            <p><strong>No. Meter:</strong> {{ $tagihan->penggunaan->pelanggan->nomor_meter }}</p>
            <p><strong>Daya:</strong> {{ $tagihan->penggunaan->pelanggan->tarif->daya }}</p>
            <hr class="dashed">
            <h5>Detail Tagihan</h5>
            <p><strong>Periode:</strong> {{ $tagihan->penggunaan->bulan }} {{ $tagihan->penggunaan->tahun }}</p>
            <p><strong>Pemakaian:</strong> {{ $tagihan->jumlah_meter }} KWH</p>
            <hr class="dashed">
            <div class="line-item">
                <span>Tagihan Listrik</span>
                <span>Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>Biaya Admin</span>
                <span>Rp {{ number_format($tagihan->pembayaran->biaya_admin, 0, ',', '.') }}</span>
            </div>
            <hr class="dashed">
            <div class="line-item fs-5 fw-bold text-dark">
                <span>TOTAL BAYAR</span>
                <span>Rp {{ number_format($tagihan->pembayaran->total_akhir, 0, ',', '.') }}</span>
            </div>
        </div>
        <div class="receipt-footer">
            <p class="mb-1">Terima kasih telah melakukan pembayaran pada
                {{ \Carbon\Carbon::parse($tagihan->pembayaran->tanggal_bayar)->format('d F Y') }}
            </p>
            <strong>LUNAS</strong>
        </div>
    </div>

    <div class="no-print">
        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        <button onclick="window.print()" class="btn btn-primary">Cetak Struk</button>
    </div>
@endsection