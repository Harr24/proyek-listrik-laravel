<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 15px;
            background-color: #198754;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .tagihan-detail {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .tagihan-detail p {
            margin: 0 0 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Form Verifikasi Pembayaran</h1>
        <a href="{{ route('admin.tagihan.index') }}">Kembali ke Daftar Tagihan</a>
        <hr>

        <div class="tagihan-detail">
            <h3>Detail Tagihan</h3>
            <p><strong>Nama Pelanggan:</strong> {{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</p>
            <p><strong>Periode:</strong> {{ $tagihan->penggunaan->bulan }} {{ $tagihan->penggunaan->tahun }}</p>
            <p><strong>Total Tagihan:</strong> Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</p>
        </div>

        <form action="{{ route('admin.pembayaran.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">

            <div class="form-group">
                <label for="tanggal_bayar">Tanggal Bayar</label>
                <input type="date" id="tanggal_bayar" name="tanggal_bayar" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="biaya_admin">Biaya Admin</label>
                <input type="number" id="biaya_admin" name="biaya_admin" value="2500" required>
            </div>

            <button type="submit" class="btn">Konfirmasi Pembayaran</button>
        </form>
    </div>
</body>

</html>