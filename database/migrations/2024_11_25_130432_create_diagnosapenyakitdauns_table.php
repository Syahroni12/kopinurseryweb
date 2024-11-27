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
        Schema::create('diagnosapenyakitdauns', function (Blueprint $table) {
            $table->id();
            $table->string('diagnosa')->nullable(false);
            $table->string('image')->nullable(false);
            $table->string('gejala')->nullable();
            $table->string('solusi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosapenyakitdauns');
    }
};
