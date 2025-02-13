<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PistasSeeder extends Seeder
{
    public function run()
    {
        DB::table('pistas')->insert([
            [
                'idpistas' => 1,
                'contenido' => 'Usa las Herramientas de desarrollador para buscar los valores de tus cookies.',
                'valor' => 20,
            ],
            [
                'idpistas' => 2,
                'contenido' => 'Algunas cookies parecen importantes, prueba a ver que pasa si las borras y recargas la página.',
                'valor' => 20,
            ],
            [
                'idpistas' => 3,
                'contenido' => 'Lee detenidamente la descripción',
                'valor' => 20,
            ],
            [
                'idpistas' => 4,
                'contenido' => 'Revisa el código de nuestra plataforma',
                'valor' => 20,
            ],
            [
                'idpistas' => 5,
                'contenido' => '¿Quién en su sano juicio pone la flag tan obvia servidor secreto de una megacorporación opresiva? pues yoooo',
                'valor' => 20,
            ],
            [
                'idpistas' => 6,
                'contenido' => 'El CEO es fanático del cifrado, pero su truco base puede ser revertido fácilmente con herramientas en línea.',
                'valor' => 20,
            ],
            [
                'idpistas' => 7,
                'contenido' => 'No todo lo que ves en una página web está realmente escondido. Busca entre las líneas.',
                'valor' => 20,
            ],
            [
                'idpistas' => 8,
                'contenido' => 'Las pistas fundamentales g y p',
                'valor' => 20,
            ],
            [
                'idpistas' => 9,
                'contenido' => '¿Conoces el cifrado Diffie-Hellman?',
                'valor' => 20,
            ],
            [
                'idpistas' => 10,
                'contenido' => 'Revisa bien el nombre del reto',
                'valor' => 20,
            ],
            [
                'idpistas' => 11,
                'contenido' => 'Céjate de RodeOs y Ten una p1sta, porque no hay 3.',
                'valor' => 20,
            ],
            [
                'idpistas' => 12,
                'contenido' => 'En estos casos es necesario recurir a el CESAR',
                'valor' => 20,
            ],
            [
                'idpistas' => 13,
                'contenido' => 'No todo es base 64',
                'valor' => 20,
            ],
            [
                'idpistas' => 14,
                'contenido' => 'La solución está en los genes',
                'valor' => 20,
            ],
            [
                'idpistas' => 15,
                'contenido' => 'Obviamente esta dento de Huaraz',
                'valor' => 20,
            ],
            [
                'idpistas' => 16,
                'contenido' => 'Uno de sus tantos lugares emblemáticos??✝️',
                'valor' => 20,
            ],
            [
                'idpistas' => 17,
                'contenido' => 'Revisa nuestras redes sociales y entérate de lo ultimo',
                'valor' => 20,
            ],
            [
                'idpistas' => 18,
                'contenido' => 'La cuenta de la IA intentaba ser más humana, pero su nombre de usuario revela mucho. Piensa en uno de los organizadores del evento.',
                'valor' => 20,
            ],
            [
                'idpistas' => 19,
                'contenido' => 'La cuenta de la IA se llama igual que del presidente de CIBERSECUNASAM. Solo necesitas tu habilidad para buscar en Twitter.',
                'valor' => 50,
            ],
        ]);
    }
}