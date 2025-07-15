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
        Schema::table('registros_equipos', function (Blueprint $table) {
            $table->foreign(['fk_competencia'], 'fk_registros_equipos_competencias1')->references(['idcompetencia'])->on('competencias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_equipo'], 'fk_registros_equipos_equipos1')->references(['idequipos'])->on('equipos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registros_equipos', function (Blueprint $table) {
            $table->dropForeign('fk_registros_equipos_competencias1');
            $table->dropForeign('fk_registros_equipos_equipos1');
        });
    }
};
