<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosCompeSeeder extends Seeder
{
    public function run()
    {
        DB::table('estados_compe')->insert([
            ['idestado_compe' => 1, 'estadocompe' => 'Activo'],
        ]);
    }
}