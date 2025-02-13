<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenciasTable extends Migration
{
    public function up()
    {
        Schema::create('competencias', function (Blueprint $table) {
            $table->id('idcompetencia');
            $table->string('nomcompe', 100);
            $table->string('descripcion', 100);
            $table->dateTime('fec_inicio');
            $table->dateTime('fec_final');
            $table->foreignId('fk_estado_compe')->constrained('estados_compe', 'idestado_compe');
            $table->foreignId('fk_tipo_compe')->constrained('tipos_compe', 'idtipo_compe');
        });
    }

    public function down()
    {
        Schema::dropIfExists('competencias');
    }
}