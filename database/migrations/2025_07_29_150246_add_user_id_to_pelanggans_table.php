<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            // TAMBAHAN BARU
            $table->unsignedBigInteger('user_id')->nullable()->after('id_pelanggan');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            // TAMBAHAN BARU
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
