<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('idequipos');
            $table->string('nomequipo', 45);
            $table->string('descripción', 100)->nullable();
            $table->string('foto', 45)->nullable();
            $table->date('fec_creacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}