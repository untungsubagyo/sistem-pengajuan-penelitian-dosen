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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('user_nidn', 18);
            $table->foreign('user_nidn')->constrained('users', 'nidn');
            $table->foreignId('id_skema')->constrained('skema_penelitian');
            $table->string('judul');
            $table->string('nama_mitra');
            $table->text('alamat_mitra');
            $table->text('kata_kunci');
            $table->text('latar_belakang');
            $table->text('ringkasan');
            $table->text('urgensi');
            $table->text('rumusan_masalah');
            $table->text('pendekatan_pemecahan_masalah');
            $table->text('kebaruan');
            $table->text('metode_penelitian');
            $table->text('jadwal_penelitian');
            $table->text('daftar_pustaka');
            $table->enum('status', ['draf', 'submitted']);
            $table->enum('status_approvel', ['diterima', 'ditolak']);
            $table->integer('nilai')->nullable();
            $table->date('tanggal_submit')->nullable();
            $table->date('approvel_date')->nullable();
            $table->text('laporan_progress');
            $table->text('laporan_akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
