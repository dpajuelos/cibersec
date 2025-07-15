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
        Schema::create('archivos_reto', function (Blueprint $table) {
            $table->bigIncrements('idarchivo');
            $table->string('nombre', 45);
            $table->string('url', 300);
            $table->string('tipo', 45);
            $table->unsignedBigInteger('fk_retos')->index('fk_archivos_reto_retos1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos_reto');
    }
};
