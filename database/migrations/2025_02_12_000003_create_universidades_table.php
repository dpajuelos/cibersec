<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversidadesTable extends Migration
{
    public function up()
    {
        Schema::create('universidades', function (Blueprint $table) {
            $table->id('iduniversidad');
            $table->string('nomuniversidad', 100);
            $table->foreignId('fk_ciudad')->constrained('ciudades', 'idciudad');
        });
    }

    public function down()
    {
        Schema::dropIfExists('universidades');
    }
}