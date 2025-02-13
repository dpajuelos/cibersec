<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosRetoSeeder extends Seeder
{
    public function run()
    {
        DB::table('estados_reto')->insert([
            ['idestado_reto' => 1, 'estadoreto' => 'Activo'],
        ]);
    }
}