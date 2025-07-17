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
        Schema::create('registros_personas', function (Blueprint $table) {
            $table->bigIncrements('idregistros');
            $table->date('fec_registro');
            $table->unsignedBigInteger('fk_perfil')->index('registros_fk_perfil_foreign');
            $table->unsignedBigInteger('fk_competencia')->index('registros_fk_competencia_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_personas');
    }
};
