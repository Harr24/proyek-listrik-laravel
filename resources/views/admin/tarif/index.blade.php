<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Data Tarif</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-family: sans-serif;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background-color: #0d6efd;
            display: inline-block;
            margin-bottom: 15px;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-delete {
            background-color: #dc3545;
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
    <h1>Kelola Data Tarif</h1>
    <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
    <hr>

    <a href="{{ route('admin.tarif.create') }}" class="btn btn-add">+ Tambah Data Baru</a>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Daya</th>
                <th>Tarif / KWH</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($semua_tarif as $tarif)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tarif->daya }}</td>
                    <td>Rp {{ number_format($tarif->tarif_per_kwh, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.tarif.edit', $tarif->id_tarif) }}" class="btn btn-edit">Edit</a>

                        {{-- PERUBAHAN DI SINI --}}
                        <form action="{{ route('admin.tarif.destroy', $tarif->id_tarif) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data tarif.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>