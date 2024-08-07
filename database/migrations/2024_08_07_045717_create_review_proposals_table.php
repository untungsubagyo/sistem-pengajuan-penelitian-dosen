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
        Schema::create('review_proposals', function (Blueprint $table) {
            $table->id();
            $table->string('id_user',18);
            $table->foreign('id_user')->references('nidn')->on('users')->onDelete('cascade');
            $table->bigInteger('id_proposal');
            $table->foreign('id_proposal')->references('id')->on('proposals')->onDelete('cascade');
            $table->date ('reviwer_data');
            $table->text ('file');
            $table->text ('catatan');
            $table->enum ('skor_rumusan_masalah', ['1', '2', '3', '4', '5']);
            $table->enum ('skor_luaran', ['1', '2', '3', '4', '5']);
            $table->enum ('skor_metode', ['1', '2', '3', '4', '5']);
            $table->enum ('skor_tinjauan_pustaka', ['1', '2', '3', '4', '5']);
            $table->enum ('skor_kelayakan_umum', ['1', '2', '3', '4', '5']);
            $table->enum ('status', ['draf', 'verify']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_proposals');
    }
};