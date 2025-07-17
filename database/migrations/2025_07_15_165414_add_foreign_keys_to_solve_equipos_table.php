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
        Schema::table('solve_equipos', function (Blueprint $table) {
            $table->foreign(['idsubmissions_teams'], 'fk_solve_equipos_submissions_teams1')->references(['idsubmissions_teams'])->on('submissions_teams')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solve_equipos', function (Blueprint $table) {
            $table->dropForeign('fk_solve_equipos_submissions_teams1');
        });
    }
};
