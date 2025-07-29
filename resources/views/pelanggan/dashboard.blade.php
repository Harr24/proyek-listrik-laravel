<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelanggan</title>
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
    </style>
</head>

<body>
    <h1>Dashboard Pelanggan</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <hr>

    <h3>Riwayat Tagihan Anda</h3>

    <!-- Tabel untuk menampilkan riwayat tagihan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Jumlah Meter</th>
                <th>Total Bayar</th>
                <th>Status</th>
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
                            <span class="status-lunas">Lunas</span>
                        @else
                            <span class="status-belum">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Anda belum memiliki riwayat tagihan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>