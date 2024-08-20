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
        Schema::create('tasktransactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tugas');
            $table->string('nim');
            $table->integer('jam_kompen');
            $table->string('semester');
            $table->date('tanggal_input');
            $table->date('tanggal_validasi');
            $table->string('keterangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasktransactions');
    }
};
