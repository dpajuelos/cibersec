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
        Schema::create('personas', function (Blueprint $table) {
            $table->string('dni', 8)->primary();
            $table->string('nombres', 60);
            $table->string('ape_paterno', 60);
            $table->string('ape_materno', 60);
            $table->date('fec_nacimiento');
            $table->string('genero', 45);
            $table->string('celular', 9);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
