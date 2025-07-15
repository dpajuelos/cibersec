<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('submissions_teams', function (Blueprint $table) {
            $table->id('idsubmissions_teams');
            $table->string('flag_enviada', 190);
            $table->dateTime('fecha');
            $table->boolean('correcto')->default(false);
            $table->foreignId('fk_idregistros_equipos')->constrained('registros_equipos', 'idregistros_equipos');
            $table->foreignId('fk_idretos')->constrained('retos', 'idretos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('submissions_teams');
    }
};
