<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Menambahkan kolom untuk bukti pembayaran
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('total_akhir');
        });

        // Mengubah status default di tabel tagihan
        Schema::table('tagihans', function (Blueprint $table) {
            // Statusnya sekarang bisa: Belum Lunas, Menunggu Konfirmasi, Lunas
            $table->string('status', 50)->default('Belum Lunas')->change();
        });
    }

    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn('bukti_pembayaran');
        });
        Schema::table('tagihans', function (Blueprint $table) {
            $table->string('status', 20)->default('Belum Lunas')->change();
        });
    }
};
