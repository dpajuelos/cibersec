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
        Schema::create('solve_equipos', function (Blueprint $table) {
            $table->integer('idsolve', true);
            $table->integer('puntos');
            $table->dateTime('time');
            $table->integer('idsubmissions_teams')->index('fk_solve_equipos_submissions_teams1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solve_equipos');
    }
};
