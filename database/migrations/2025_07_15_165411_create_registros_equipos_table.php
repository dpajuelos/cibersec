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
        Schema::create('registros_equipos', function (Blueprint $table) {
            $table->bigIncrements('idregistros_equipos');
            $table->date('fec_registro');
            $table->unsignedBigInteger('fk_equipo')->index('fk_registros_equipos_equipos1_idx');
            $table->unsignedBigInteger('fk_competencia')->index('fk_registros_equipos_competencias1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_equipos');
    }
};
