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
        Schema::table('submissions_teams', function (Blueprint $table) {
            $table->foreign(['fk_idregistros_equipos'], 'fk_submissions_teams_registros_equipos1')->references(['idregistros_equipos'])->on('registros_equipos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_idretos'], 'fk_submissions_teams_retos1')->references(['idretos'])->on('retos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions_teams', function (Blueprint $table) {
            $table->dropForeign('fk_submissions_teams_registros_equipos1');
            $table->dropForeign('fk_submissions_teams_retos1');
        });
    }
};
