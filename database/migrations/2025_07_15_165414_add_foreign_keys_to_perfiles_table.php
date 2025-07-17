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
        Schema::table('perfiles', function (Blueprint $table) {
            $table->foreign(['fk_nivel'])->references(['idnivel'])->on('niveles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_persona'])->references(['dni'])->on('personas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_universidad'])->references(['iduniversidad'])->on('universidades')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_usuario'])->references(['idusuario'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfiles', function (Blueprint $table) {
            $table->dropForeign('perfiles_fk_nivel_foreign');
            $table->dropForeign('perfiles_fk_persona_foreign');
            $table->dropForeign('perfiles_fk_universidad_foreign');
            $table->dropForeign('perfiles_fk_usuario_foreign');
        });
    }
};
