<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('registros_equipos', function (Blueprint $table) {
            $table->id('idregistros_equipos');
            $table->date('fec_registro');
            $table->foreignId('fk_equipo')->constrained('equipos', 'idequipos');
            $table->foreignId('fk_competencia')->constrained('competencias', 'idcompetencia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registros_equipos');
    }
};
