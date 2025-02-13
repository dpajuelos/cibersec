<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadosTable extends Migration
{
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->id('idresultado');
            $table->string('resultado', 45);
        });
    }

    public function down()
    {
        Schema::dropIfExists('resultados');
    }
}