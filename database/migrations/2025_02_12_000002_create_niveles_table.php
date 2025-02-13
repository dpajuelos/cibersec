<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesTable extends Migration
{
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {
            $table->id('idnivel');
            $table->string('nomnivel', 45);
        });
    }

    public function down()
    {
        Schema::dropIfExists('niveles');
    }
}