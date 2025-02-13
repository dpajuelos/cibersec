<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolucionesTable extends Migration
{
    public function up()
    {
        Schema::create('soluciones', function (Blueprint $table) {
            $table->id('idsoluciones');
            $table->string('contenido', 45);
            $table->date('fec_publicacion')->default(now());
            $table->foreignId('fk_retos')->constrained('retos', 'idretos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('soluciones');
    }
}