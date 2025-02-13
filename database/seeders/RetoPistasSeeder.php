<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RetoPistasSeeder extends Seeder
{
    public function run()
    {
        DB::table('reto_pistas')->insert([
            [
                'idreto_pistas' => 1,
                'fk_retos' => 2,
                'fk_pistas' => 1,
            ],
            [
                'idreto_pistas' => 2,
                'fk_retos' => 2,
                'fk_pistas' => 2,
            ],
            [
                'idreto_pistas' => 3,
                'fk_retos' => 3,
                'fk_pistas' => 3,
            ],
            [
                'idreto_pistas' => 4,
                'fk_retos' => 4,
                'fk_pistas' => 4,
            ],
            [
                'idreto_pistas' => 5,
                'fk_retos' => 6,
                'fk_pistas' => 5,
            ],
            [
                'idreto_pistas' => 6,
                'fk_retos' => 7,
                'fk_pistas' => 6,
            ],
            [
                'idreto_pistas' => 7,
                'fk_retos' => 12,
                'fk_pistas' => 8,
            ],
            [
                'idreto_pistas' => 8,
                'fk_retos' => 12,
                'fk_pistas' => 9,
            ],
            [
                'idreto_pistas' => 9,
                'fk_retos' => 8,
                'fk_pistas' => 7,
            ],
            [
                'idreto_pistas' => 10,
                'fk_retos' => 13,
                'fk_pistas' => 10,
            ],
            [
                'idreto_pistas' => 11,
                'fk_retos' => 13,
                'fk_pistas' => 11,
            ],
            [
                'idreto_pistas' => 12,
                'fk_retos' => 14,
                'fk_pistas' => 12,
            ],
            [
                'idreto_pistas' => 13,
                'fk_retos' => 14,
                'fk_pistas' => 13,
            ],
            [
                'idreto_pistas' => 14,
                'fk_retos' => 14,
                'fk_pistas' => 14,
            ],
            [
                'idreto_pistas' => 15,
                'fk_retos' => 15,
                'fk_pistas' => 15,
            ],
            [
                'idreto_pistas' => 16,
                'fk_retos' => 15,
                'fk_pistas' => 16,
            ],
            [
                'idreto_pistas' => 17,
                'fk_retos' => 16,
                'fk_pistas' => 17,
            ],
            [
                'idreto_pistas' => 18,
                'fk_retos' => 17,
                'fk_pistas' => 18,
            ],
            [
                'idreto_pistas' => 19,
                'fk_retos' => 17,
                'fk_pistas' => 19,
            ],
        ]);
    }
}