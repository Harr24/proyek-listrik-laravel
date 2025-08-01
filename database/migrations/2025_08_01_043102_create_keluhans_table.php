<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User yang mengirim keluhan
            $table->string('judul');
            $table->text('deskripsi');
            // Status: Dibuka, Ditangani, Selesai
            $table->string('status')->default('Dibuka');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluhans');
    }
};
