<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('submissions_personas', function (Blueprint $table) {
            $table->id('idsubmissions_personas');
            $table->string('flag_enviada', 150);
            $table->dateTime('fecha');
            $table->boolean('correcto')->default(false);
            $table->foreignId('fk_idregistros')->constrained('registros_personas', 'idregistros');
            $table->foreignId('fk_idretos')->constrained('retos', 'idretos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('submissions_personas');
    }
};
