@extends('layouts.app')

@section('title', 'Daftar Harga')

@section('content')
    <div class="container px-4 py-5" id="harga">
        <h2 class="pb-2 border-bottom text-center">Daftar Harga Tarif Listrik</h2>
        <p class="text-center text-muted">Berikut adalah daftar harga tarif listrik pascabayar yang kami tawarkan.</p>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 py-5">

            @forelse ($semua_tarif as $tarif)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-center bg-primary text-white">
                            <h4 class="my-0 fw-normal">Daya {{ $tarif->daya }}</h4>
                        </div>
                        <div class="card-body text-center">
                            <h1 class="card-title pricing-card-title">Rp
                                {{ number_format($tarif->tarif_per_kwh, 0, ',', '.') }}<small
                                    class="text-muted fw-light">/kWh</small></h1>
                            <p class="mt-3 mb-4">
                                Cocok untuk kebutuhan rumah tangga dan usaha kecil dengan penggunaan listrik yang efisien.
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Daftar harga belum tersedia saat ini.</p>
                </div>
            @endforelse

        </div>
    </div>
@endsection