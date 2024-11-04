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
        Schema::create('monicontrollings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alat')->length(3);
            $table->float('nilai_humidity', 5, 2)->nullable(false);
            $table->float('nilai_temperature', 5, 2)->nullable(false);
            $table->foreign('id_alat')->references('id')->on('alats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monicontrollings');
    }
};
