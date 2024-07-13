<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Podcasts;

class PodcastsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Podcasts::class;
    
    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'slug' =>  Str::slug($this->faker->userName()),
            'autor' => $this->faker->randomElement($usuarios),
            'temporada' => $this->faker->numberBetween(1, 10),
            'episodio' => $this->faker->numberBetween(1, 100),
            'titulo' => $this->faker->sentence,
            'capa_do_episodio' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'descricao_do_episodio' => $this->faker->text(),
            'conteudo_da_publicacao' => $this->faker->text(),
            'endereco_do_audio' => $this->faker->url(),
            'agregadores' => [
                'spotify' => $this->faker->url(),
                'apple_podcasts' => $this->faker->url(),
                'google_podcasts' => $this->faker->url(),
                'amazon_music' => $this->faker->url(),
                'deezer' => $this->faker->url(),
                'castbox' => $this->faker->url(),
                'podchaser' => $this->faker->url(),
                'jiosaavn' => $this->faker->url(),
                'gaana' => $this->faker->url(),
                'hubhopper' => $this->faker->url(),
                'wink' => $this->faker->url(),
                'episodes' => $this->faker->url(),
            ],
        ];
    }
}
