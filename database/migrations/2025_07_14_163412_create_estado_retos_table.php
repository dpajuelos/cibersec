<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('estados_reto', function (Blueprint $table) {
            $table->id('idestado_reto');
            $table->string('estadoreto', 75);
        });
    }

    public function down()
    {
        Schema::dropIfExists('estados_reto');
    }
};
