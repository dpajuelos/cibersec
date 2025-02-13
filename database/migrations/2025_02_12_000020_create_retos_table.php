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
            $table->text('descripcion')->nullable();
            $table->foreignId('fk_categoria')->constrained('categorias', 'idcategoria');
            $table->foreignId('fk_archivo')->nullable()->constrained('archivos_reto', 'idarchivo');
            $table->foreignId('fk_nivel')->default(1)->constrained('niveles_reto', 'idnivel_reto');
            $table->foreignId('fk_competencia')->default(1)->constrained('competencias', 'idcompetencia');
            $table->foreignId('fk_estado_reto')->default(1)->constrained('estados_reto', 'idestado_reto');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retos');
    }
}