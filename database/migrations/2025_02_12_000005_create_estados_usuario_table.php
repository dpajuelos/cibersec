<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosUsuarioTable extends Migration
{
    public function up()
    {
        Schema::create('estados_usuario', function (Blueprint $table) {
            $table->id('idestado');
            $table->string('estadousuario', 45);
        });
    }

    public function down()
    {
        Schema::dropIfExists('estados_usuario');
    }
}