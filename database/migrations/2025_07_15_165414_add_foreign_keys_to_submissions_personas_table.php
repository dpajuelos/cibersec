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
        Schema::table('submissions_personas', function (Blueprint $table) {
            $table->foreign(['fk_idregistros'], 'fk_submissions_personas_registros_personas1')->references(['idregistros'])->on('registros_personas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_idretos'], 'fk_submissions_personas_retos1')->references(['idretos'])->on('retos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions_personas', function (Blueprint $table) {
            $table->dropForeign('fk_submissions_personas_registros_personas1');
            $table->dropForeign('fk_submissions_personas_retos1');
        });
    }
};
