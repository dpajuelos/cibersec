<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sesiones', function (Blueprint $table) {
            $table->char('idsesiones', 36)->primary();
            $table->string('ip_address', 45);
            $table->date('created_at');
            $table->date('expires_at');
            $table->foreignId('fk_idusuario')->constrained('usuarios', 'idusuario');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesiones');
    }
};
