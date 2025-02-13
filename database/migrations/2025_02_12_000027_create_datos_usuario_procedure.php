<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDatosUsuarioProcedure extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE PROCEDURE datos_usuario(IN nombreCompleto VARCHAR(255))
            BEGIN
                SELECT 
                    j.idjuegos, 
                    CONCAT_WS(' ', per.nombres, per.ape_paterno, per.ape_materno) AS usuario, 
                    j.cantidad, 
                    j.tiempo, 
                    j.bandera_enviada, 
                    r.resultado, 
                    re.puntos, 
                    re.nomreto, 
                    ca.nomcategoria, 
                    es.estadoreto
                FROM 
                    juegos j
                    INNER JOIN perfiles p ON j.fk_perfil = p.idperfil 
                    INNER JOIN personas per ON p.fk_persona = per.idpersona 
                    INNER JOIN resultados r ON j.fk_resultado = r.idresultado
                    INNER JOIN retos re ON j.fk_retos = re.idretos 
                    INNER JOIN categorias ca ON re.fk_categoria = ca.idcategoria
                    INNER JOIN estados_reto es ON re.fk_estado_reto = es.idestado_reto
                WHERE 
                    CONCAT_WS(' ', per.nombres, per.ape_paterno, per.ape_materno) = nombreCompleto;
            END
        ");
    }

    public function down()
    {
        DB::statement('DROP PROCEDURE IF EXISTS datos_usuario');
    }
}