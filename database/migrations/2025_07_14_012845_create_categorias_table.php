<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('idcategoria');
            $table->string('nomcategoria', 70);
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
};
