<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idusuario');
            $table->string('usuario', 45);
            $table->string('email', 70);
            $table->text('password');
            $table->date('fec_registro');
            $table->foreignId('fk_estadousuario')->constrained('estados_usuario', 'idestado');
            $table->text('foto')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}