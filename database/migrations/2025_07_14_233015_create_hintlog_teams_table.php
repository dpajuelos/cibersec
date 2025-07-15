<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hintlogs_teams', function (Blueprint $table) {
            $table->id('idhintlogs_teams');
            $table->dateTime('fecha');
            $table->foreignId('fk_idsubmissions_teams')->constrained('submissions_teams', 'idsubmissions_teams');
            $table->foreignId('fk_idpistas')->constrained('pistas', 'idpistas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hintlogs_teams');
    }
};
