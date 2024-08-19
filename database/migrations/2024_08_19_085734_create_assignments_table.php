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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tugas');
            $table->foreignId('nip');
            $table->string('judul_tugas');
            $table->string('tipe_tugas');
            $table->integer('kuota');
            $table->integer('jumlah_kompen');
            $table->date('date');
            $table->string('deskripsi');
            $table->integer('ditutup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
