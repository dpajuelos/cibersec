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
        Schema::create('perfiles', function (Blueprint $table) {
            $table->bigIncrements('idperfil');
            $table->text('biografia');
            $table->string('link', 80);
            $table->unsignedBigInteger('fk_usuario')->index('perfiles_fk_usuario_foreign');
            $table->unsignedBigInteger('fk_nivel')->index('perfiles_fk_nivel_foreign');
            $table->unsignedBigInteger('fk_universidad')->index('perfiles_fk_universidad_foreign');
            $table->string('fk_persona', 8)->index('perfiles_fk_persona_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
