<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Input Data Penggunaan</title>
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
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 15px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Form Input Data Penggunaan</h1>
    <a href="{{ route('admin.penggunaan.index') }}">Kembali ke Daftar Penggunaan</a>
    <hr>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.penggunaan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_pelanggan">Pilih Pelanggan</label>
            <select name="id_pelanggan" id="id_pelanggan" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($semua_pelanggan as $pelanggan)
                    <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nomor_meter }} -
                        {{ $pelanggan->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="bulan">Bulan</label>
            <input type="text" id="bulan" name="bulan" value="{{ old('bulan') }}" required
                placeholder="Contoh: Januari">
        </div>
        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input type="number" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" required
                placeholder="Contoh: 2024">
        </div>
        <div class="form-group">
            <label for="meter_awal">Meter Awal (KWH)</label>
            <input type="number" id="meter_awal" name="meter_awal" value="{{ old('meter_awal') }}" required>
        </div>
        <div class="form-group">
            <label for="meter_akhir">Meter Akhir (KWH)</label>
            <input type="number" id="meter_akhir" name="meter_akhir" value="{{ old('meter_akhir') }}" required>
        </div>
        <button type="submit" class="btn">Simpan</button>
    </form>

</body>

</html>