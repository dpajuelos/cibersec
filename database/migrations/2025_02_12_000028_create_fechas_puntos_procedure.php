<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFechasPuntosProcedure extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE PROCEDURE fechas_puntos(
                IN usuarioNombre VARCHAR(100), 
                IN categoriaNombre VARCHAR(50)
            )
            BEGIN
                SELECT 
                    j.idjuegos, 
                    CONCAT_WS(' ', per.nombres, per.ape_paterno, per.ape_materno) AS usuario,
                    DATE_FORMAT(j.tiempo, '%b %e') AS fecha, 
                    r.resultado, 
                    re.puntos, 
                    re.nomreto, 
                    ca.nomcategoria
                FROM 
                    juegos j  
                    INNER JOIN perfiles p ON j.fk_perfil = p.idperfil 
                    INNER JOIN personas per ON p.fk_persona = per.idpersona 
                    INNER JOIN resultados r ON j.fk_resultado = r.idresultado
                    INNER JOIN retos re ON j.fk_retos = re.idretos 
                    INNER JOIN categorias ca ON re.fk_categoria = ca.idcategoria
                WHERE 
                    CONCAT_WS(' ', per.nombres, per.ape_paterno, per.ape_materno) = usuarioNombre
                    AND ca.nomcategoria = categoriaNombre
                    AND j.fk_resultado = 1;
            END
        ");
    }

    public function down()
    {
        DB::statement('DROP PROCEDURE IF EXISTS fechas_puntos');
    }
}