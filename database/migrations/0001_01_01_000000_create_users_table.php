<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('nidn', 10)->primary();
            $table->string('nama'); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nip', 18); // Changed from integer to string
            $table->string('no_telepon', 13); // Changed from integer to string
            $table->enum('jabatan_fungsional', ['asisten_ahli', 'rektor', 'rektor_kepala', 'guru_besar']);
            $table->string('rumpun', 100);
            $table->string('password'); 
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
