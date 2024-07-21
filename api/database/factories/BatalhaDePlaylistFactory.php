<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\BatalhaDePlaylist;

class BatalhaDePlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usuario = \App\Models\Usuarios::pluck('id')->toArray();
        
        return [
            'imagem' =>  \Illuminate\Http\UploadedFile::fake()->image('banner.jpg'),
            'primeiro_competidor' => $this->faker->randomElement($usuario),
            'segundo_competidor' => $this->faker->randomElement($usuario),
        ];
    }
}
