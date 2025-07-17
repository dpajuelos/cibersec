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
        Schema::create('submissions_teams', function (Blueprint $table) {
            $table->integer('idsubmissions_teams')->primary();
            $table->string('flag_enviada', 45);
            $table->dateTime('fecha');
            $table->boolean('correcto?');
            $table->unsignedBigInteger('fk_idregistros_equipos')->index('fk_submissions_teams_registros_equipos1_idx');
            $table->unsignedBigInteger('fk_idretos')->index('fk_submissions_teams_retos1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions_teams');
    }
};
