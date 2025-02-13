<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePistasTable extends Migration
{
    public function up()
    {
        Schema::create('pistas', function (Blueprint $table) {
            $table->id('idpistas');
            $table->string('contenido', 200);
            $table->integer('valor')->default(20);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pistas');
    }
}