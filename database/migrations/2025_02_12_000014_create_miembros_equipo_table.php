<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembrosEquipoTable extends Migration
{
    public function up()
    {
        Schema::create('miembros_equipo', function (Blueprint $table) {
            $table->id('idmiembros');
            $table->string('rol', 45);
            $table->date('fec_union');
            $table->foreignId('fk_equipos')->constrained('equipos', 'idequipos');
            $table->foreignId('fk_perfil')->constrained('perfiles', 'idperfil');
        });
    }

    public function down()
    {
        Schema::dropIfExists('miembros_equipo');
    }
}