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
        Schema::table('usuarios_has_roles', function (Blueprint $table) {
            $table->foreign(['roles_idroles'], 'fk_usuarios_has_roles_roles1')->references(['idroles'])->on('roles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['usuarios_idusuario'], 'fk_usuarios_has_roles_usuarios1')->references(['idusuario'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios_has_roles', function (Blueprint $table) {
            $table->dropForeign('fk_usuarios_has_roles_roles1');
            $table->dropForeign('fk_usuarios_has_roles_usuarios1');
        });
    }
};
