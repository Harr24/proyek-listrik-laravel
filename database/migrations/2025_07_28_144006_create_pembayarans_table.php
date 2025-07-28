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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');

            // Kolom untuk foreign key ke tabel tagihans
            $table->unsignedBigInteger('id_tagihan');

            $table->date('tanggal_bayar');
            $table->unsignedInteger('biaya_admin')->default(2500);
            $table->unsignedInteger('total_akhir');
            $table->timestamps();

            // Mendefinisikan foreign key (penghubung ke tabel tagihans)
            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};