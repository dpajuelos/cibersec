<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('idpersona');
            $table->string('nombres', 60);
            $table->string('ape_paterno', 60);
            $table->string('ape_materno', 60);
            $table->string('dni', 8);
            $table->date('fec_nacimiento');
            $table->string('genero', 45);
            $table->string('celular', 9);
        });
    }

    public function down()
    {
        Schema::dropIfExists('personas');
    }
}