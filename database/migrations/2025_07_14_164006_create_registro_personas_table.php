<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('registros_personas', function (Blueprint $table) {
            $table->id('idregistros');
            $table->date('fec_registro');
            $table->foreignId('fk_perfil')->constrained('perfiles', 'idperfil');
            $table->foreignId('fk_competencia')->constrained('competencias', 'idcompetencia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registros_personas');
    }
};
