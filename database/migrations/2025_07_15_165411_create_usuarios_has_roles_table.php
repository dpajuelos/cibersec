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
        Schema::create('usuarios_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('usuarios_idusuario')->index('fk_usuarios_has_roles_usuarios1_idx');
            $table->integer('roles_idroles')->index('fk_usuarios_has_roles_roles1_idx');
            $table->date('fecha');

            $table->primary(['usuarios_idusuario', 'roles_idroles']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_has_roles');
    }
};
