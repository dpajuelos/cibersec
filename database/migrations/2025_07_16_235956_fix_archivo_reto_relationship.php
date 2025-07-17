<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Eliminar la restricción de clave foránea (por nombre)
        Schema::table('archivos_reto', function (Blueprint $table) {
            // Elimina la FK por nombre
            $table->dropForeign('fk_archivos_reto_retos1');

            // Luego elimina la columna
            $table->dropColumn('fk_retos');
        });

        // 2. Agregar fk_archivo a retos y su FK
        Schema::table('retos', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_archivo')->nullable()->after('fk_estado_reto');
            $table->foreign('fk_archivo')
                ->references('idarchivo')
                ->on('archivos_reto')
                ->onDelete('set null');
        });
    }



    public function down(): void
    {
        Schema::table('retos', function (Blueprint $table) {
            $table->dropForeign(['fk_archivo']);
            $table->dropColumn('fk_archivo');
        });

        Schema::table('archivos_reto', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_retos')->nullable();
            $table->foreign('fk_retos')
                ->references('idretos')
                ->on('retos')
                ->onDelete('set null');
        });
    }
};
