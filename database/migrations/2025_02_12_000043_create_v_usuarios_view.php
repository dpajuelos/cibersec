<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVUsuariosView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW v_usuarios AS
            SELECT 
                us.foto,
                CONCAT_WS(' ', pe.nombres, pe.ape_paterno, pe.ape_materno) AS usuario,
                eu.estadousuario,
                p.link,
                u.nomuniversidad,
                us.usuario AS nickname
            FROM 
                perfiles p
                INNER JOIN personas pe ON p.fk_persona = pe.idpersona
                INNER JOIN universidades u ON p.fk_universidad = u.iduniversidad
                INNER JOIN usuarios us ON p.fk_usuario = us.idusuario
                INNER JOIN estados_usuario eu ON us.fk_estadousuario = eu.idestado
        ");
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS v_usuarios');
    }
}