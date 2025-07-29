<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Data Pelanggan</title>
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

        .btn {
            padding: 6px 12px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
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

        .action-form {
            display: inline;
        }
    </style>
</head>

<body>
    <h1>Kelola Data Pelanggan</h1>
    <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
    <hr>

    <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-add">+ Tambah Pelanggan Baru</a>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Meter</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Daya Tarif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($semua_pelanggan as $pelanggan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pelanggan->nomor_meter }}</td>
                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                    <td>{{ $pelanggan->alamat }}</td>
                    <td>{{ $pelanggan->tarif->daya ?? 'Tarif Dihapus' }}</td>
                    <td>
                        <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.pelanggan.destroy', $pelanggan) }}" method="POST" class="action-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>