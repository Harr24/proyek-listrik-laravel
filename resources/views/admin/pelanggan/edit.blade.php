<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Pelanggan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 15px;
            background-color: #ffc107;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h1>Form Edit Data Pelanggan</h1>
    <a href="{{ route('admin.pelanggan.index') }}">Kembali ke Daftar Pelanggan</a>
    <hr>

    @if ($errors->any())
        <div style="color: red;">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pelanggan.update', $pelanggan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nomor_meter">Nomor Meter</label>
            <input type="text" id="nomor_meter" name="nomor_meter"
                value="{{ old('nomor_meter', $pelanggan->nomor_meter) }}" required>
        </div>
        <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
        </div>
        <div class="form-group">
            <label for="id_tarif">Jenis Tarif</label>
            <select name="id_tarif" id="id_tarif" required>
                <option value="">-- Pilih Tarif --</option>
                @foreach ($semua_tarif as $tarif)
                    <option value="{{ $tarif->id_tarif }}" @if($tarif->id_tarif == old('id_tarif', $pelanggan->id_tarif))
                    selected @endif>
                        {{ $tarif->daya }} - (Rp {{ number_format($tarif->tarif_per_kwh) }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">Update Data</button>
    </form>

</body>

</html>