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
        Schema::create('akreditasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('puskesmas_id');
            $table->float('bab_1')->nullable();
            $table->float('bab_2')->nullable();
            $table->float('bab_3')->nullable();
            $table->float('bab_4')->nullable();
            $table->float('bab_5')->nullable();
            $table->float('nilai_akhir')->nullable();
            $table->date('tanggal_sa');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('puskesmas_id')->references('id')->on('puskesmas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akreditasis');
    }
};
