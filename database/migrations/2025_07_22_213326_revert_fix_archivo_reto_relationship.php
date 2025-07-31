<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Eliminar columna fk_archivo y su FK de la tabla retos
        Schema::table('retos', function (Blueprint $table) {
            // Eliminar la clave foránea si existe
            $table->dropForeign(['fk_archivo']);
            $table->dropColumn('fk_archivo');
        });

        // 2. Agregar columna fk_retos de nuevo a archivos_reto con su FK
        Schema::table('archivos_reto', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_retos')->nullable();

            $table->foreign('fk_retos', 'fk_archivos_reto_retos1') // nombre explícito (opcional)
                ->references('idretos')
                ->on('retos')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Dejar el down en blanco o revertir los cambios hechos arriba si deseas
        Schema::table('archivos_reto', function (Blueprint $table) {
            $table->dropForeign(['fk_retos']);
            $table->dropColumn('fk_retos');
        });

        Schema::table('retos', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_archivo')->nullable();
            $table->foreign('fk_archivo')
                ->references('idarchivo')
                ->on('archivos_reto')
                ->onDelete('set null');
        });
    }
};
