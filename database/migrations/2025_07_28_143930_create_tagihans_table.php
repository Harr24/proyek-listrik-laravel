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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('id_tagihan');

            // Kolom untuk foreign key ke tabel penggunaans
            $table->unsignedBigInteger('id_penggunaan');

            $table->integer('jumlah_meter');
            $table->unsignedInteger('total_bayar');
            $table->string('status', 20)->default('Belum Lunas');
            $table->timestamps();

            // Mendefinisikan foreign key (penghubung ke tabel penggunaans)
            $table->foreign('id_penggunaan')->references('id_penggunaan')->on('penggunaans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};