<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skema_penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_skema', 255);
            $table->enum('sumber_dana', ["Internal", "Eksternal"]);
            $table->integer('durasi');
            $table->enum('satuan_durasi', ["Bulan", "Tahun"]);
            $table->integer('total_biaya');
            $table->integer('bobot_rumusan_masalah');
            $table->integer('bobot_luaran');
            $table->integer('bobot_metode');
            $table->integer('bobot_tinjauan_pustaka');
            $table->integer('bobot_kelayakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skema_penelitians');
    }
};
