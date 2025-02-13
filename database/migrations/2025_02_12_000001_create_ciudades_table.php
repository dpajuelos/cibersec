<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadesTable extends Migration
{
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id('idciudad');
            $table->string('nomciudad', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
}