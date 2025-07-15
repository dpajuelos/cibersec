<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {
            $table->id('idnivel');  // BIGINT autoincrement
            $table->string('nomnivel', 70);
        });
    }

    public function down()
    {
        Schema::dropIfExists('niveles');
    }
};
