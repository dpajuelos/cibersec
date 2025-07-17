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
        Schema::table('miembros_equipo', function (Blueprint $table) {
            $table->foreign(['fk_equipos'])->references(['idequipos'])->on('equipos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_perfil'])->references(['idperfil'])->on('perfiles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('miembros_equipo', function (Blueprint $table) {
            $table->dropForeign('miembros_equipo_fk_equipos_foreign');
            $table->dropForeign('miembros_equipo_fk_perfil_foreign');
        });
    }
};
