<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarifs', function (Blueprint $table) {
            // Ini akan membuat primary key dengan nama 'id_tarif'
            $table->id('id_tarif');

            // Ini membuat kolom untuk teks dengan nama 'daya' dan batas 50 karakter
            $table->string('daya', 50);

            // Ini membuat kolom untuk angka (tanpa koma) dengan nama 'tarif_per_kwh'
            $table->unsignedInteger('tarif_per_kwh');

            // Ini otomatis membuat kolom 'created_at' dan 'updated_at'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifs');
    }
};