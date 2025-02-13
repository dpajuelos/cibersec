<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelesSeeder extends Seeder
{
    public function run()
    {
        DB::table('niveles')->insert([
            ['idnivel' => 1, 'nomnivel' => 'Básico'],
        ]);
    }
}