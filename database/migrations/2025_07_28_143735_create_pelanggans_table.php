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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('id_pelanggan');

            // Kolom untuk foreign key ke tabel tarifs
            $table->unsignedBigInteger('id_tarif');

            $table->string('nomor_meter', 20)->unique();
            $table->string('nama_pelanggan');
            $table->text('alamat');
            $table->timestamps();

            // Mendefinisikan foreign key (penghubung ke tabel tarifs)
            $table->foreign('id_tarif')->references('id_tarif')->on('tarifs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};