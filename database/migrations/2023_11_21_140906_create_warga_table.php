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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('nik')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('nomor_telepon')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['l', 'p'])->nullable();
            $table->enum('kewarganegaraan', ['wni', 'wna'])->nullable();
            $table->enum('agama', ['islam', 'kristen_protestan', 'kristen_katolik', 'hindu', 'buddha', 'konghucu'])->nullable();
            $table->enum('pendidikan_terakhir', ['sd', 'smp', 'sma', 'diploma', 'sarjana', 'magister', 'doktor'])->nullable();
            $table->enum('status', ['belum_menikah', 'menikah', 'cerai_hidup', 'cerai_mati'])->nullable();
            $table->string('kelurahan')->default('Perwira')->nullable();
            $table->string('kecamatan')->default('Bekasi Utara')->nullable();
            $table->string('rt')->default('005')->nullable();
            $table->string('rw')->default('014')->nullable();
            $table->string('nomor_rumah')->nullable();
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
