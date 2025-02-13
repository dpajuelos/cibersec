<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchivosRetoSeeder extends Seeder
{
    public function run()
    {
        DB::table('archivos_reto')->insert([
            [
                'nombre' => '',
                'url' => 'https://challenges.hackrocks.com/wanna-some-cookies',
                'tipo' => 'URL',
            ],
            [
                'nombre' => '',
                'url' => 'https://challenges.hackrocks.com/dont-save-me',
                'tipo' => 'URL',
            ],
            [
                'nombre' => '',
                'url' => 'https://jean05blas.github.io/Atento-al-antivirus/',
                'tipo' => 'URL',
            ],
            [
                'nombre' => '',
                'url' => 'https://jean05blas.github.io/Blog-del-CEO/',
                'tipo' => 'URL',
            ],
            [
                'nombre' => '',
                'url' => 'https://jean05blas.github.io/Interceptando-mensajes/',
                'tipo' => 'URL',
            ],
            [
                'nombre' => '',
                'url' => 'https://jean05blas.github.io/Mensajes-Fragmentados/',
                'tipo' => 'URL',
            ],
            [
                'nombre' => 'imagen1.png',
                'url' => '',
                'tipo' => 'IMAGE',
            ],
            [
                'nombre' => 'abba.rar',
                'url' => '',
                'tipo' => 'RAR',
            ],
            [
                'nombre' => 'FR4CM4SON.rar',
                'url' => 'dcode.fr',
                'tipo' => 'FEABD',
            ],
            [
                'nombre' => 'multicripto.txt',
                'url' => '',
                'tipo' => 'TXT',
            ],
            [
                'nombre' => 'openyoureyes.png',
                'url' => '',
                'tipo' => 'PNG',
            ],
            [
                'nombre' => 'loguito.jpg',
                'url' => '',
                'tipo' => 'JPG',
            ],
            [
                'nombre' => 'sole.jpg',
                'url' => '',
                'tipo' => 'JPG',
            ],
            [
                'nombre' => '',
                'url' => 'https://github.com/Jean05Blas/HOLAS/blob/main/Trivia8_logo.png',
                'tipo' => 'URL',
            ],
        ]);
    }
}