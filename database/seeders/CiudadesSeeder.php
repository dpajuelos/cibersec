<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadesSeeder extends Seeder
{
    public function run()
    {
        DB::table('ciudades')->insert([
            ['idciudad' => 1, 'nomciudad' => 'Huaraz'],
            ['idciudad' => 2, 'nomciudad' => 'Otros'],
        ]);
    }
}