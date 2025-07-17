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
        Schema::create('certificaciones_personas', function (Blueprint $table) {
            $table->bigIncrements('idcertificaciones_personas');
            $table->date('emision_personas');
            $table->unsignedBigInteger('fk_registropersonas')->index('fk_certificaciones_personas_registros_personas1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificaciones_personas');
    }
};
