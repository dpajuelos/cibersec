<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultadosSeeder extends Seeder
{
    public function run()
    {
        DB::table('resultados')->insert([
            ['idresultado' => 1, 'resultado' => 'Resuelto'],
            ['idresultado' => 2, 'resultado' => 'Fallido'],
        ]);
    }
}