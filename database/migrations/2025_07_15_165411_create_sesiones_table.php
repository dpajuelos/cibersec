<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sesiones', function (Blueprint $table) {
            $table->char('idsesiones', 1)->primary();
            $table->string('ip_address', 45);
            $table->date('created_at');
            $table->date('expires_at');
            $table->unsignedBigInteger('fk_idusuario')->index('fk_sesiones_usuarios1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones');
    }
};
