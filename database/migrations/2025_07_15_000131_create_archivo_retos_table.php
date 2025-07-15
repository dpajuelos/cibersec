<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('archivos_reto', function (Blueprint $table) {
            $table->id('idarchivo');
            $table->string('nombre', 65);
            $table->string('url', 600);
            $table->string('tipo', 65);
            $table->foreignId('fk_retos')->constrained('retos', 'idretos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivos_reto');
    }
};
