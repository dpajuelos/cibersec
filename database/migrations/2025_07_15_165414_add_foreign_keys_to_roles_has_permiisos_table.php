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
        Schema::table('roles_has_permiisos', function (Blueprint $table) {
            $table->foreign(['idpermiisos'], 'fk_roles_has_permiisos_permiisos1')->references(['idpermiisos'])->on('permiisos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['idroles'], 'fk_roles_has_permiisos_roles1')->references(['idroles'])->on('roles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles_has_permiisos', function (Blueprint $table) {
            $table->dropForeign('fk_roles_has_permiisos_permiisos1');
            $table->dropForeign('fk_roles_has_permiisos_roles1');
        });
    }
};
