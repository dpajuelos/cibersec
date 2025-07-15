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
        Schema::create('competencias', function (Blueprint $table) {
            $table->bigIncrements('idcompetencia');
            $table->string('nomcompe', 100);
            $table->string('descripcion', 100);
            $table->dateTime('fec_inicio');
            $table->dateTime('fec_final');
            $table->unsignedBigInteger('fk_estado_compe')->index('competencias_fk_estado_compe_foreign');
            $table->unsignedBigInteger('fk_tipo_compe')->index('competencias_fk_tipo_compe_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencias');
    }
};
