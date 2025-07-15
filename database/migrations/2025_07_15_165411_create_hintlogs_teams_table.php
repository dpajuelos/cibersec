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
        Schema::create('hintlogs_teams', function (Blueprint $table) {
            $table->integer('idhintlogs_teams')->primary();
            $table->dateTime('fecha');
            $table->integer('fk_idsubmissions_teams')->index('fk_hintlogs_teams_submissions_teams1_idx');
            $table->unsignedBigInteger('fk_idpistas')->index('fk_hintlogs_teams_pistas1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hintlogs_teams');
    }
};
