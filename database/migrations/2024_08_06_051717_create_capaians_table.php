<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('capaians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_proposal')->unsigned();
            $table->foreign('id_proposal')->references('id')->on('proposals')->onDelete('cascade');
            $table->year('tahun');
            $table->enum('jenis_capaian', ['Naskah Jurnal', 'HKI', 'Buku Ajar']);
            $table->string('indikator', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('capaians');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};