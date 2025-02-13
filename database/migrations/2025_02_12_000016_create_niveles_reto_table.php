<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesRetoTable extends Migration
{
    public function up()
    {
        Schema::create('niveles_reto', function (Blueprint $table) {
            $table->id('idnivel_reto');
            $table->string('nomnivelreto', 45);
        });
    }

    public function down()
    {
        Schema::dropIfExists('niveles_reto');
    }
}