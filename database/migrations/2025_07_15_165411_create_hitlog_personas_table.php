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
        Schema::create('hitlog_personas', function (Blueprint $table) {
            $table->integer('idhitlog_personas', true);
            $table->dateTime('fecha');
            $table->integer('fk_idsubmissions_personas')->index('fk_hitlog_personas_submissions_personas1_idx');
            $table->unsignedBigInteger('fk_idpistas')->index('fk_hitlog_personas_pistas1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitlog_personas');
    }
};
