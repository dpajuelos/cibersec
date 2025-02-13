<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenciasSeeder extends Seeder
{
    public function run()
    {
        DB::table('competencias')->insert([
            [
                'idcompetencia' => 1,
                'nomcompe' => 'Aniversario Sistemas',
                'descripcion' => 'Lorem',
                'fec_inicio' => '2024-11-21 00:00:00',
                'fec_final' => '2024-11-21 00:00:00',
                'fk_estado_compe' => 1,
                'fk_tipo_compe' => 1,
            ],
        ]);
    }
}