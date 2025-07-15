<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roles_has_permisos', function (Blueprint $table) {
            $table->foreignId('idroles')->constrained('roles', 'idroles');
            $table->foreignId('idpermisos')->constrained('permisos', 'idpermisos');
            $table->date('datecreate');
            $table->primary(['idroles', 'idpermisos']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles_has_permisos');
    }
};
