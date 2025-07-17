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
        Schema::create('retos', function (Blueprint $table) {
            $table->bigIncrements('idretos');
            $table->integer('puntos');
            $table->string('nomreto', 125);
            $table->text('descripcion');
            $table->string('flag', 45);
            $table->unsignedBigInteger('fk_categoria')->index('retos_fk_categoria_foreign');
            $table->unsignedBigInteger('fk_nivel')->default(1)->index('retos_fk_nivel_foreign');
            $table->unsignedBigInteger('fk_competencia')->default(1)->index('retos_fk_competencia_foreign');
            $table->unsignedBigInteger('fk_estado_reto')->default(1)->index('retos_fk_estado_reto_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retos');
    }
};
