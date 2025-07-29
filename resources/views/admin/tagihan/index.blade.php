<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Data Tagihan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .status-lunas {
            color: green;
            font-weight: bold;
        }

        .status-belum {
            color: red;
            font-weight: bold;
        }

        .btn {
            padding: 6px 12px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }

        .btn-verify {
            background-color: #0dcaf0;
        }

        .alert-success {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <h1>Kelola Data Tagihan</h1>
    <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
    <hr>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
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
                    <td>{{ $tagihan->penggunaan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                    <td>{{ $tagihan->penggunaan->bulan ?? 'N/A' }} {{ $tagihan->penggunaan->tahun ?? '' }}</td>
                    <td>{{ $tagihan->jumlah_meter }} KWH</td>
                    <td>Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</td>
                    <td>
                        @if($tagihan->status == 'Lunas')
                            <span class="status-lunas">Lunas</span>
                        @else
                            <span class="status-belum">Belum Lunas</span>
                        @endif
                    </td>
                    <td>
                        @if($tagihan->status == 'Belum Lunas')
                            {{-- PERUBAHAN DI SINI --}}
                            <a href="{{ route('admin.pembayaran.create', $tagihan) }}" class="btn btn-verify">Verifikasi</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data tagihan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>