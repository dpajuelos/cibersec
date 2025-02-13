<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePuntosPuestoProcedure extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE PROCEDURE puntos_puesto(IN nicknamegaa VARCHAR(50))
            BEGIN
                SELECT 
                    nickname, 
                    total_puntos, 
                    puesto
                FROM 
                    v_ranking
                WHERE 
                    nickname = nicknamegaa;
            END
        ");
    }

    public function down()
    {
        DB::statement('DROP PROCEDURE IF EXISTS puntos_puesto');
    }
}