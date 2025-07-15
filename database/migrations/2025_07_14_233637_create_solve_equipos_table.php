<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('solve_equipos', function (Blueprint $table) {
            $table->id('idsolve');
            $table->integer('puntos');
            $table->dateTime('time');
            $table->foreignId('fk_idsubmissions_teams')->constrained('submissions_teams', 'idsubmissions_teams');
        });
    }

    public function down()
    {
        Schema::dropIfExists('solve_equipos');
    }
};
