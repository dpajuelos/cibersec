<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVRankingView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW v_ranking AS
            SELECT 
                usu.usuario AS nickname,
                CONCAT_WS(' ', per.nombres, per.ape_paterno, per.ape_materno) AS usuario,
                SUM(CASE WHEN j.fk_resultado = 1 THEN re.puntos ELSE 0 END) - COALESCE(SUM(CASE WHEN j.fk_reto_pistas IS NOT NULL THEN pi.valor ELSE 0 END), 0) AS total_puntos,
                DENSE_RANK() OVER (ORDER BY SUM(CASE WHEN j.fk_resultado = 1 THEN re.puntos ELSE 0 END) - COALESCE(SUM(CASE WHEN j.fk_reto_pistas IS NOT NULL THEN pi.valor ELSE 0 END), 0) DESC) AS puesto
            FROM 
                juegos j
                INNER JOIN perfiles p ON j.fk_perfil = p.idperfil
                INNER JOIN personas per ON p.fk_persona = per.idpersona
                INNER JOIN usuarios usu ON p.fk_usuario = usu.idusuario
                INNER JOIN retos re ON j.fk_retos = re.idretos
                LEFT JOIN reto_pistas rp ON j.fk_reto_pistas = rp.idreto_pistas
                LEFT JOIN pistas pi ON rp.fk_pistas = pi.idpistas
            GROUP BY 
                usu.usuario, per.nombres, per.ape_paterno, per.ape_materno
            ORDER BY 
                puesto
        ");
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS v_ranking');
    }
}