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
        Schema::table('registros_personas', function (Blueprint $table) {
            $table->foreign(['fk_competencia'], 'registros_fk_competencia_foreign')->references(['idcompetencia'])->on('competencias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_perfil'], 'registros_fk_perfil_foreign')->references(['idperfil'])->on('perfiles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registros_personas', function (Blueprint $table) {
            $table->dropForeign('registros_fk_competencia_foreign');
            $table->dropForeign('registros_fk_perfil_foreign');
        });
    }
};
