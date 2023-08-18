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
        Schema::create('elemens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bab_id');
            $table->string('kriteria');
            $table->string('standar');
            $table->integer('no_urut');
            $table->text('elemen');
            $table->text('regulasi')->default('');
            $table->text('dokumen_bukti')->default('');
            $table->text('observasi')->default('');
            $table->text('wawancara')->default('');
            $table->text('simulasi')->default('');
            $table->timestamps();
            $table->foreign('bab_id')->references('id')->on('babs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemens');
    }
};
