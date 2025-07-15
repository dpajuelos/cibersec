<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hitlog_personas', function (Blueprint $table) {
            $table->id('idhitlog_personas');
            $table->dateTime('fecha');
            $table->foreignId('fk_idsubmissions_personas')->constrained('submissions_personas', 'idsubmissions_personas');
            $table->foreignId('fk_idpistas')->constrained('pistas', 'idpistas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hitlog_personas');
    }
};
