<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['idcategoria' => 1, 'nomcategoria' => 'Web'],
            ['idcategoria' => 2, 'nomcategoria' => 'Esteganografía'],
            ['idcategoria' => 3, 'nomcategoria' => 'Criptografía'],
            ['idcategoria' => 4, 'nomcategoria' => 'OSINT'],
            ['idcategoria' => 5, 'nomcategoria' => 'Trivias'],
        ]);
    }
}