<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosUsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('estados_usuario')->insert([
            ['idestado' => 1, 'estadousuario' => 'Activo'],
        ]);
    }
}