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
        Schema::create('miembros_equipo', function (Blueprint $table) {
            $table->bigIncrements('idmiembros');
            $table->string('rol', 45);
            $table->date('fec_union');
            $table->unsignedBigInteger('fk_equipos')->index('miembros_equipo_fk_equipos_foreign');
            $table->unsignedBigInteger('fk_perfil')->index('miembros_equipo_fk_perfil_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miembros_equipo');
    }
};
