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
        Schema::table('retos_has_pistas', function (Blueprint $table) {
            $table->foreign(['idpistas'], 'fk_retos_has_pistas_pistas1')->references(['idpistas'])->on('pistas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['idretos'], 'fk_retos_has_pistas_retos1')->references(['idretos'])->on('retos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retos_has_pistas', function (Blueprint $table) {
            $table->dropForeign('fk_retos_has_pistas_pistas1');
            $table->dropForeign('fk_retos_has_pistas_retos1');
        });
    }
};
