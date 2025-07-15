<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('usuarios_has_roles', function (Blueprint $table) {
            $table->foreignId('usuarios_idusuario')->constrained('users', 'id');
            $table->foreignId('roles_idroles')->constrained('roles', 'idroles');
            $table->date('fecha');
            $table->primary(['usuarios_idusuario', 'roles_idroles']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios_has_roles');
    }
};
