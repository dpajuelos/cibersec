<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateObtenerPorcentajeAciertoFunction extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE FUNCTION obtener_porcentaje_acierto(nombre_usuario VARCHAR(100), nombre_categoria VARCHAR(50))
            RETURNS DECIMAL(5,2)
            DETERMINISTIC
            BEGIN
                DECLARE porcentaje_acierto DECIMAL(5,2);

                SELECT ROUND(
                           SUM(CASE WHEN j.fk_resultado = 1 THEN 1 ELSE 0 END) * 100.0 / COUNT(*),
                           2
                       ) INTO porcentaje_acierto
                FROM juegos j  
                     INNER JOIN perfiles p ON j.fk_perfil = p.idperfil 
                     INNER JOIN personas per ON p.fk_persona = per.idpersona 
                     INNER JOIN resultados r ON j.fk_resultado = r.idresultado
                     INNER JOIN retos re ON j.fk_retos = re.idretos 
                     INNER JOIN categorias ca ON re.fk_categoria = ca.idcategoria
                WHERE CONCAT_WS(' ', per.nombres, per.ape_paterno, per.ape_materno) = nombre_usuario 
                      AND ca.nomcategoria = nombre_categoria;

                RETURN porcentaje_acierto;
            END
        ");
    }

    public function down()
    {
        DB::statement('DROP FUNCTION IF EXISTS obtener_porcentaje_acierto');
    }
}