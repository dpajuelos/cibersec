<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetosTable extends Migration
{
    public function up()
    {
        Schema::create('retos', function (Blueprint $table) {
            $table->id('idretos');
            $table->integer('puntos');
            $table->string('nomreto', 125);
            $table->text('descripcion');
            $table->string('flag', 250);
            $table->foreignId('fk_categoria')->constrained('categorias', 'idcategoria');
            $table->foreignId('fk_nivel')->constrained('niveles_reto', 'idnivel_reto');
            $table->foreignId('fk_competencia')->constrained('competencias', 'idcompetencia');
            $table->foreignId('fk_estado_reto')->constrained('estados_reto', 'idestado_reto');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retos');
    }
}
