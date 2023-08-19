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
        Schema::create('penilaian_elemens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('elemen_id');
            $table->unsignedBigInteger('akreditasi_id');
            $table->integer('nilai')->nullable();
            $table->text('fakta_analisis');
            $table->string('foto');
            $table->timestamps();
            $table->foreign('elemen_id')->references('id')->on('elemens');
            $table->foreign('akreditasi_id')->references('id')->on('akreditasis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_elemens');
    }
};
