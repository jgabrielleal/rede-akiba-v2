<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Reviews;

class ReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Reviews::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'slug' =>  Str::slug($this->faker->sentence($nbWords = 6, $variableNbWords = true)),
            'autor' => $this->faker->randomElement($usuarios),
            'imagem_em_destaque' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'capa_do_review' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'titulo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'sinopse' => $this->faker->text(),
            'conteudo' => $this->faker->text(),
            'reacoes' => [
                'gostei' => $this->faker->numberBetween(0, 100),
                'amei' => $this->faker->numberBetween(0, 100),
                'surpreso' => $this->faker->numberBetween(0, 100),
                'triste' => $this->faker->numberBetween(0, 100),
                'raiva' => $this->faker->numberBetween(0, 100),
            ]
        ];
    }
}
