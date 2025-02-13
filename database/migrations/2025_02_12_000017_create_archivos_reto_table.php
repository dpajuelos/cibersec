<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosRetoTable extends Migration
{
    public function up()
    {
        Schema::create('archivos_reto', function (Blueprint $table) {
            $table->id('idarchivo');
            $table->string('nombre', 45);
            $table->string('url', 300);
            $table->string('tipo', 45);
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivos_reto');
    }
}