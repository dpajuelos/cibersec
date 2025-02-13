<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelesRetoSeeder extends Seeder
{
    public function run()
    {
        DB::table('niveles_reto')->insert([
            ['idnivel_reto' => 1, 'nomnivelreto' => 'Básico'],
        ]);
    }
}