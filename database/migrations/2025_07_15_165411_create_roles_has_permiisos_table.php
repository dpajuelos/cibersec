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
        Schema::create('roles_has_permiisos', function (Blueprint $table) {
            $table->integer('idroles')->index('fk_roles_has_permiisos_roles1_idx');
            $table->integer('idpermiisos')->index('fk_roles_has_permiisos_permiisos1_idx');
            $table->date('datecreate');

            $table->primary(['idroles', 'idpermiisos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_has_permiisos');
    }
};
