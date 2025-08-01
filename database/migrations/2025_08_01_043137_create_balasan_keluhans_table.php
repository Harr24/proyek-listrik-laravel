<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('balasan_keluhans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keluhan_id');
            $table->unsignedBigInteger('user_id'); // User yang membalas
            $table->text('pesan');
            $table->string('gambar')->nullable(); // Untuk menyimpan path/nama file gambar
            $table->timestamps();

            $table->foreign('keluhan_id')->references('id')->on('keluhans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balasan_keluhans');
    }
};
