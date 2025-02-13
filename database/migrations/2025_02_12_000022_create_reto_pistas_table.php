<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetoPistasTable extends Migration
{
    public function up()
    {
        Schema::create('reto_pistas', function (Blueprint $table) {
            $table->id('idreto_pistas');
            $table->foreignId('fk_retos')->constrained('retos', 'idretos');
            $table->foreignId('fk_pistas')->nullable()->constrained('pistas', 'idpistas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reto_pistas');
    }
}