<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversidadesSeeder extends Seeder
{
    public function run()
    {
        DB::table('universidades')->insert([
            ['iduniversidad' => 1, 'nomuniversidad' => 'Universidad Nacional Santiago Antúnez de Mayolo', 'fk_ciudad' => 1],
            ['iduniversidad' => 2, 'nomuniversidad' => 'Universidad César Vallejo', 'fk_ciudad' => 1],
            ['iduniversidad' => 3, 'nomuniversidad' => 'Otros', 'fk_ciudad' => 2],
        ]);
    }
}