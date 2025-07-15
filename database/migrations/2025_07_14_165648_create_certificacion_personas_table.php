<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('certificaciones_personas', function (Blueprint $table) {
            $table->id('idcertificaciones_personas');
            $table->date('emision_personas');
            $table->foreignId('fk_registropersonas')->constrained('registros_personas', 'idregistros');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificaciones_personas');
    }
};
