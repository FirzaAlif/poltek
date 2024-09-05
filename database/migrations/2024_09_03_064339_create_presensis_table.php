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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->integer('JamAlpa');
            $table->integer('MenitAlpa');
            $table->integer('JamIjin');
            $table->integer('MenitIjin');
            $table->integer('JamSakit');
            $table->integer('MenitSakit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
