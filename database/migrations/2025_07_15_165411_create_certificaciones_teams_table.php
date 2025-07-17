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
        Schema::create('certificaciones_teams', function (Blueprint $table) {
            $table->bigIncrements('idcertificaciones_teams');
            $table->date('emision_teams');
            $table->unsignedBigInteger('fk_registroteams')->index('fk_certificaciones_teams_registros_equipos1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificaciones_teams');
    }
};
