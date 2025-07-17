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
        Schema::table('universidades', function (Blueprint $table) {
            $table->foreign(['fk_ciudad'])->references(['idciudad'])->on('ciudades')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('universidades', function (Blueprint $table) {
            $table->dropForeign('universidades_fk_ciudad_foreign');
        });
    }
};
