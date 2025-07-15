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
        Schema::create('submissions_personas', function (Blueprint $table) {
            $table->integer('idsubmissions_personas')->primary();
            $table->string('flag_enviada', 45);
            $table->dateTime('fecha');
            $table->boolean('correcto?');
            $table->unsignedBigInteger('fk_idregistros')->index('fk_submissions_personas_registros_personas1_idx');
            $table->unsignedBigInteger('fk_idretos')->index('fk_submissions_personas_retos1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions_personas');
    }
};
