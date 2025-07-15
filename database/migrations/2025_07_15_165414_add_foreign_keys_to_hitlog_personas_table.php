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
        Schema::table('hitlog_personas', function (Blueprint $table) {
            $table->foreign(['fk_idpistas'], 'fk_hitlog_personas_pistas1')->references(['idpistas'])->on('pistas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_idsubmissions_personas'], 'fk_hitlog_personas_submissions_personas1')->references(['idsubmissions_personas'])->on('submissions_personas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hitlog_personas', function (Blueprint $table) {
            $table->dropForeign('fk_hitlog_personas_pistas1');
            $table->dropForeign('fk_hitlog_personas_submissions_personas1');
        });
    }
};
