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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengantar')->unique()->nullable();
            $table->unsignedBigInteger('warga_id');
            $table->foreign('warga_id')->references('id')->on('wargas');
            $table->string('keperluan');
            $table->enum('status_rt', ['pending', 'accepted', 'declined'])->default('pending');
            $table->enum('status_rw', ['pending', 'accepted', 'declined'])->default('pending');
            $table->enum('keterangan', ['pending', 'accepted', 'declined', 'archive'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
