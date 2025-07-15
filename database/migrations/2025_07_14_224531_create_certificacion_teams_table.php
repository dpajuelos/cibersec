<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('certificaciones_teams', function (Blueprint $table) {
            $table->id('idcertificaciones_teams');
            $table->date('emision_teams');
            $table->foreignId('fk_registroteams')->constrained('registros_equipos', 'idregistros_equipos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificaciones_teams');
    }
};
