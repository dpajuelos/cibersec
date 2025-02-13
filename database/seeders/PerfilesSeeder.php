<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilesSeeder extends Seeder
{
    public function run()
    {
        DB::table('perfiles')->insert([
            [
                'idperfil' => 40,
                'biografia' => null,
                'link' => null,
                'fk_usuario' => 45,
                'fk_nivel' => 1,
                'fk_universidad' => 1,
                'fk_certificaciones' => null,
                'fk_persona' => 51,
            ],
            [
                'idperfil' => 41,
                'biografia' => null,
                'link' => null,
                'fk_usuario' => 46,
                'fk_nivel' => 1,
                'fk_universidad' => 1,
                'fk_certificaciones' => null,
                'fk_persona' => 52,
            ],
            [
                'idperfil' => 42,
                'biografia' => null,
                'link' => null,
                'fk_usuario' => 47,
                'fk_nivel' => 1,
                'fk_universidad' => 1,
                'fk_certificaciones' => null,
                'fk_persona' => 53,
            ],
            [
                'idperfil' => 43,
                'biografia' => null,
                'link' => null,
                'fk_usuario' => 48,
                'fk_nivel' => 1,
                'fk_universidad' => 1,
                'fk_certificaciones' => null,
                'fk_persona' => 54,
            ],
            [
                'idperfil' => 44,
                'biografia' => null,
                'link' => null,
                'fk_usuario' => 49,
                'fk_nivel' => 1,
                'fk_universidad' => 2,
                'fk_certificaciones' => null,
                'fk_persona' => 55,
            ],
        ]);
    }
}