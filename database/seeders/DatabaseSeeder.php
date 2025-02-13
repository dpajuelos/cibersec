<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ArchivosRetoSeeder::class,
            CategoriasSeeder::class,
            TiposCompeSeeder::class,
            CiudadesSeeder::class,
            UniversidadesSeeder::class,
            EstadosCompeSeeder::class,
            EstadosRetoSeeder::class,
            EstadosUsuarioSeeder::class,
            NivelesRetoSeeder::class,
            CompetenciasSeeder::class,
            PersonasSeeder::class,
            NivelesSeeder::class,
            UsuariosSeeder::class,
            PerfilesSeeder::class,
            PistasSeeder::class,
            RetosSeeder::class,
            RetoPistasSeeder::class,
            ResultadosSeeder::class,
            SolucionesSeeder::class,
            JuegosSeeder::class,
            
        ]);
    }
}