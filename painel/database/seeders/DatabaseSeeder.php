<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsuariosTableSeeder::class,
            MateriasTableSeeder::class,
            PodcastsTableSeeder::class,
            OuvinteDoMesSeeder::class,
            BatalhaDePlaylistSeeder::class,
            // Adicione suas outras classes de seed aqui...
        ]);    
    }
}
