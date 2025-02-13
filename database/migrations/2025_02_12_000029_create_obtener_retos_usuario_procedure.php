<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateObtenerRetosUsuarioProcedure extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE PROCEDURE obtener_retos_usuario(IN reto_id INT)
            BEGIN
                SELECT 
                    re.nomreto,
                    usu.usuario AS nickname,
                    CONCAT_WS(' ', per.ape_paterno, per.ape_materno, per.nombres) AS nombre,
                    un.nomuniversidad,
                    DATE_FORMAT(j.tiempo, '%H:%i %d/%m/%Y') AS tiempo_formateado
                FROM 
                    juegos j
                    INNER JOIN perfiles p ON j.fk_perfil = p.idperfil
                    INNER JOIN personas per ON p.fk_persona = per.idpersona
                    INNER JOIN usuarios usu ON p.fk_usuario = usu.idusuario
                    INNER JOIN universidades un ON p.fk_universidad = un.iduniversidad
                    INNER JOIN retos re ON j.fk_retos = re.idretos
                WHERE 
                    j.fk_retos = reto_id AND j.fk_resultado = 1
                ORDER BY 
                    j.tiempo DESC;
            END
        ");
    }

    public function down()
    {
        DB::statement('DROP PROCEDURE IF EXISTS obtener_retos_usuario');
    }
}