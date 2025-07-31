<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - {{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
        }

        .receipt-container {
            max-width: 450px;
            margin: 50px auto;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .receipt-body {
            padding: 30px;
        }

        .receipt-body h5 {
            font-weight: bold;
        }

        .receipt-body p {
            margin-bottom: 5px;
        }

        .receipt-footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }

        .line-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        hr {
            border-top: 1px dashed #8c8b8b;
        }

        .no-print {
            margin-top: 20px;
            text-align: center;
        }

        @media print {
            body {
                background-color: white;
            }

            .no-print {
                display: none;
            }

            .receipt-container {
                margin: 0;
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h3>STRUK PEMBAYARAN LISTRIK</h3>
            <p>LISTRIK PASCABAYAR</p>
        </div>
        <div class="receipt-body">
            <h5>Detail Pelanggan</h5>
            <p><strong>Nama:</strong> {{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</p>
            <p><strong>No. Meter:</strong> {{ $tagihan->penggunaan->pelanggan->nomor_meter }}</p>
            <p><strong>Daya:</strong> {{ $tagihan->penggunaan->pelanggan->tarif->daya }}</p>
            <hr>
            <h5>Detail Tagihan</h5>
            <p><strong>Periode:</strong> {{ $tagihan->penggunaan->bulan }} {{ $tagihan->penggunaan->tahun }}</p>
            <p><strong>Pemakaian:</strong> {{ $tagihan->jumlah_meter }} KWH</p>
            <hr>
            <div class="line-item">
                <span>Tagihan Listrik</span>
                <span>Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>Biaya Admin</span>
                <span>Rp {{ number_format($tagihan->pembayaran->biaya_admin, 0, ',', '.') }}</span>
            </div>
            <hr>
            <div class="line-item fs-5 fw-bold">
                <span>TOTAL BAYAR</span>
                <span>Rp {{ number_format($tagihan->pembayaran->total_akhir, 0, ',', '.') }}</span>
            </div>
        </div>
        <div class="receipt-footer">
            <p>Terima kasih telah melakukan pembayaran pada
                {{ \Carbon\Carbon::parse($tagihan->pembayaran->tanggal_bayar)->format('d F Y') }}</p>
            <strong>LUNAS</strong>
        </div>
    </div>

    <div class="no-print">
        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        <button onclick="window.print()" class="btn btn-primary">Cetak Struk</button>
    </div>
</body>

</html>