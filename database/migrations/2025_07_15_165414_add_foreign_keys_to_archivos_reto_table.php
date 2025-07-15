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
        Schema::table('archivos_reto', function (Blueprint $table) {
            $table->foreign(['fk_retos'], 'fk_archivos_reto_retos1')->references(['idretos'])->on('retos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('archivos_reto', function (Blueprint $table) {
            $table->dropForeign('fk_archivos_reto_retos1');
        });
    }
};
