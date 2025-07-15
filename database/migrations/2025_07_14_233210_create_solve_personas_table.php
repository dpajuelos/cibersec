<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('solve_personas', function (Blueprint $table) {
            $table->id('idsolve');
            $table->integer('puntos');
            $table->dateTime('time');
            $table->foreignId('fk_idsubmissions_personas')->constrained('submissions_personas', 'idsubmissions_personas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('solve_personas');
    }
};
