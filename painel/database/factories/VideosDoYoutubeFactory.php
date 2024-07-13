<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\VideosDoYoutube;

class VideosDoYoutubeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = VideosDoYoutube::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'autor' => $this->faker->randomElement($usuarios),
            'titulo_do_video' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'identificador_do_video' => $this->faker->url(),
        ];
    }
}
