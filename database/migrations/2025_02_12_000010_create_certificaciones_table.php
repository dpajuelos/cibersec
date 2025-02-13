<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificacionesTable extends Migration
{
    public function up()
    {
        Schema::create('certificaciones', function (Blueprint $table) {
            $table->id('idcertificaciones');
            $table->date('fe_emision');
            $table->foreignId('fk_competencia')->constrained('competencias', 'idcompetencia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificaciones');
    }
}