<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuegosTable extends Migration
{
    public function up()
    {
        Schema::create('juegos', function (Blueprint $table) {
            $table->id('idjuegos');
            $table->integer('cantidad');
            $table->dateTime('tiempo');
            $table->string('bandera_enviada', 45);
            $table->foreignId('fk_perfil')->constrained('perfiles', 'idperfil');
            $table->foreignId('fk_resultado')->constrained('resultados', 'idresultado');
            $table->foreignId('fk_retos')->constrained('retos', 'idretos');
            $table->foreignId('fk_reto_pistas')->nullable()->constrained('reto_pistas', 'idreto_pistas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('juegos');
    }
}