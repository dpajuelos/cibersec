<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pistas', function (Blueprint $table) {
            $table->id('idpistas');
            $table->string('contenido', 300);
            $table->integer('valor');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pistas');
    }
};
