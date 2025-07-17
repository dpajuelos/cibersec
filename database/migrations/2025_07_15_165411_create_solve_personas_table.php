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
        Schema::create('solve_personas', function (Blueprint $table) {
            $table->integer('idsolve', true);
            $table->integer('puntos');
            $table->dateTime('time');
            $table->integer('fk_idsubmissions_personas')->index('fk_solve_submissions_personas1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solve_personas');
    }
};
