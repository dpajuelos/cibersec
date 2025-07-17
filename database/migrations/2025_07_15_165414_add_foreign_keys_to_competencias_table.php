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
        Schema::table('competencias', function (Blueprint $table) {
            $table->foreign(['fk_estado_compe'])->references(['idestado_compe'])->on('estados_compe')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_tipo_compe'])->references(['idtipo_compe'])->on('tipos_compe')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competencias', function (Blueprint $table) {
            $table->dropForeign('competencias_fk_estado_compe_foreign');
            $table->dropForeign('competencias_fk_tipo_compe_foreign');
        });
    }
};
