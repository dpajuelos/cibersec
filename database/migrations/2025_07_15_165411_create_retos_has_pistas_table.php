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
        Schema::create('retos_has_pistas', function (Blueprint $table) {
            $table->unsignedBigInteger('idretos')->index('fk_retos_has_pistas_retos1_idx');
            $table->unsignedBigInteger('idpistas')->index('fk_retos_has_pistas_pistas1_idx');

            $table->primary(['idretos', 'idpistas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retos_has_pistas');
    }
};
