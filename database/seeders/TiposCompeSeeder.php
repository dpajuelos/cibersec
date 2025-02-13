<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposCompeSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_compe')->insert([
            ['idtipo_compe' => 1, 'tipocompe' => 'Capture the flag'],
        ]);
    }
}