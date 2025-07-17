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
        Schema::table('retos', function (Blueprint $table) {
            $table->foreign(['fk_categoria'])->references(['idcategoria'])->on('categorias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_competencia'])->references(['idcompetencia'])->on('competencias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_estado_reto'])->references(['idestado_reto'])->on('estados_reto')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_nivel'])->references(['idnivel_reto'])->on('niveles_reto')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retos', function (Blueprint $table) {
            $table->dropForeign('retos_fk_categoria_foreign');
            $table->dropForeign('retos_fk_competencia_foreign');
            $table->dropForeign('retos_fk_estado_reto_foreign');
            $table->dropForeign('retos_fk_nivel_foreign');
        });
    }
};
