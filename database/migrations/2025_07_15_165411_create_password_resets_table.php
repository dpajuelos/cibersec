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
        Schema::create('password_resets', function (Blueprint $table) {
            $table->char('token', 64)->primary();
            $table->date(' issued_at');
            $table->date(' expires_at');
            $table->date('consumed_at')->nullable();
            $table->unsignedBigInteger('usuarios_idusuario')->index('fk_password_resets_usuarios1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_resets');
    }
};
