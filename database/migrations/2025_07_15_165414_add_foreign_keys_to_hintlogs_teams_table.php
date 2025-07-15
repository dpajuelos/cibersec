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
        Schema::table('hintlogs_teams', function (Blueprint $table) {
            $table->foreign(['fk_idpistas'], 'fk_hintlogs_teams_pistas1')->references(['idpistas'])->on('pistas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_idsubmissions_teams'], 'fk_hintlogs_teams_submissions_teams1')->references(['idsubmissions_teams'])->on('submissions_teams')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hintlogs_teams', function (Blueprint $table) {
            $table->dropForeign('fk_hintlogs_teams_pistas1');
            $table->dropForeign('fk_hintlogs_teams_submissions_teams1');
        });
    }
};
