<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposCompeTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_compe', function (Blueprint $table) {
            $table->id('idtipo_compe');
            $table->string('tipocompe', 45);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_compe');
    }
}