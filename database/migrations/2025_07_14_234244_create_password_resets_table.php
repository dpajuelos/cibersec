<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->char('token', 64)->primary();
            $table->date('issued_at');
            $table->date('expires_at');
            $table->date('consumed_at')->nullable();
            $table->foreignId('usuarios_idusuario')->constrained('users', 'id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};
