<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
{
    public function run()
    {
        DB::table('personas')->insert([
            [
                'idpersona' => 51,
                'nombres' => 'Davis',
                'ape_paterno' => 'Pajuelo',
                'ape_materno' => 'Salvador',
                'dni' => '73537421',
                'fec_nacimiento' => '2003-12-13',
                'genero' => 'Masculino',
                'celular' => '927961026',
            ],
            [
                'idpersona' => 52,
                'nombres' => 'Hector',
                'ape_paterno' => 'Pajuelo',
                'ape_materno' => 'Salvador',
                'dni' => '76164421',
                'fec_nacimiento' => '2003-12-13',
                'genero' => 'Masculino',
                'celular' => '927961026',
            ],
            [
                'idpersona' => 53,
                'nombres' => 'Jean',
                'ape_paterno' => 'Blas',
                'ape_materno' => 'Avila',
                'dni' => '80808080',
                'fec_nacimiento' => '2003-12-13',
                'genero' => 'Femenino',
                'celular' => '927961026',
            ],
            [
                'idpersona' => 54,
                'nombres' => 'Jeshu',
                'ape_paterno' => 'Chavez',
                'ape_materno' => 'Huaman',
                'dni' => '90909090',
                'fec_nacimiento' => '2003-12-13',
                'genero' => 'Femenino',
                'celular' => '927961025',
            ],
            [
                'idpersona' => 55,
                'nombres' => 'Keisy',
                'ape_paterno' => 'Salas',
                'ape_materno' => 'Rondan',
                'dni' => '10101010',
                'fec_nacimiento' => '2003-12-13',
                'genero' => 'Femenino',
                'celular' => '927961026',
            ],
        ]);
    }
}