<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'idusuario' => 45,
                'usuario' => 'Hell2u',
                'email' => 'dpajuelos@unasam.edu.pe',
                'password' => '$2y$12$S0Y5TL8PH12YfQ5bIeFAW.tlBYrfY149sfUtgn4x.HQbsLaTMgavq',
                'fec_registro' => '2024-11-21',
                'fk_estadousuario' => 1,
                'foto' => 'profile-photos/LfSPksmPA3KrOZTievfELhyZoFKbyEIZijRlWRO1.jpg',
            ],
            [
                'idusuario' => 46,
                'usuario' => 'Gambi',
                'email' => 'hector@ucv.edu.pe',
                'password' => '$2y$12$fCC.eQsLzjUF8uHkasa2OOC72ERge0Pq874DuKEhlWcsVP4Y7bxqm',
                'fec_registro' => '2024-11-22',
                'fk_estadousuario' => 1,
                'foto' => 'profile-photos/6740fc5623bba.png',
            ],
            [
                'idusuario' => 47,
                'usuario' => 'blas',
                'email' => 'blas@unasam.edu.pe',
                'password' => '$2y$12$pCdbuAU3VrgWWTnxdoE9F.iOe.lqTsmeHwK.EMMG1tQhuVVVFk8u.',
                'fec_registro' => '2024-11-22',
                'fk_estadousuario' => 1,
                'foto' => 'profile-photos/6740fe8a3eb1b.png',
            ],
            [
                'idusuario' => 48,
                'usuario' => 'Mr Puchitos',
                'email' => 'jeshu@ucv.edu.pe',
                'password' => '$2y$12$i6vblE/fFCGEifz5bgtXeu9XEucp5ql9qjszZISzr4nGqpA7rrHFi',
                'fec_registro' => '2024-11-22',
                'fk_estadousuario' => 1,
                'foto' => 'profile-photos/6740fee79e7b6.png',
            ],
            [
                'idusuario' => 49,
                'usuario' => 'Freyja',
                'email' => 'keisy@ucv.edu.pe',
                'password' => '$2y$12$iP4VVOgd1L6.chZqKi1hPe.v9qOWwATQEvKCjioqzI6Xti3urV0ru',
                'fec_registro' => '2024-11-22',
                'fk_estadousuario' => 1,
                'foto' => 'profile-photos/6740ff3f01384.png',
            ],
        ]);
    }
}