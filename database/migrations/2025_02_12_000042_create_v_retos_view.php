<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVRetosView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW v_retos AS
            SELECT 
                rt.idretos,
                rt.nomreto,
                rt.puntos,
                rt.descripcion,
                ct.nomcategoria,
                pt.nombre,
                pt.url,
                pt.tipo
            FROM 
                retos rt
                INNER JOIN niveles_reto lvl ON rt.fk_nivel = lvl.idnivel_reto
                INNER JOIN categorias ct ON rt.fk_categoria = ct.idcategoria
                INNER JOIN estados_reto et ON rt.fk_estado_reto = et.idestado_reto
                LEFT JOIN archivos_reto pt ON rt.fk_archivo = pt.idarchivo
            WHERE 
                et.estadoreto = 'Activo'
        ");
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS v_retos');
    }
}