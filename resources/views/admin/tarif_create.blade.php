<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Data Tarif</title>
    <style>
        /* Anda bisa menambahkan CSS di sini jika perlu */
    </style>
</head>

<body>
    <h1>Form Tambah Data Tarif</h1>
    <a href="{{ route('admin.tarif.index') }}">Kembali ke Daftar Tarif</a>
    <hr>

    {{-- Menampilkan error validasi --}}
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

    <form action="{{ route('admin.tarif.store') }}" method="POST">
        @csrf <div>
            <label for="daya">Daya</label><br>
            <input type="text" id="daya" name="daya" value="{{ old('daya') }}" required placeholder="Contoh: 900VA">
        </div>
        <br>
        <div>
            <label for="tarif_per_kwh">Tarif / KWH</label><br>
            <input type="number" id="tarif_per_kwh" name="tarif_per_kwh" value="{{ old('tarif_per_kwh') }}" required
                placeholder="Contoh: 1352">
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>