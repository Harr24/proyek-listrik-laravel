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
        Schema::create('penggunaans', function (Blueprint $table) {
            $table->id('id_penggunaan');

            // Kolom untuk foreign key ke tabel pelanggans
            $table->unsignedBigInteger('id_pelanggan');

            $table->string('bulan', 20);
            $table->string('tahun', 4);
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->timestamps();

            // Mendefinisikan foreign key (penghubung ke tabel pelanggans)
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaans');
    }
};