<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilesTable extends Migration
{
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id('idperfil');
            $table->text('biografia')->nullable();
            $table->string('link', 80)->nullable();
            $table->foreignId('fk_usuario')->constrained('usuarios', 'idusuario');
            $table->foreignId('fk_nivel')->constrained('niveles', 'idnivel');
            $table->foreignId('fk_universidad')->constrained('universidades', 'iduniversidad');
            $table->foreignId('fk_certificaciones')->nullable()->constrained('certificaciones', 'idcertificaciones');
            $table->foreignId('fk_persona')->constrained('personas', 'idpersona');
        });
    }

    public function down()
    {
        Schema::dropIfExists('perfiles');
    }
}