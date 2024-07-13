<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Eventos;

class EventosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'slug' =>  Str::slug($this->faker->sentence($nbWords = 6, $variableNbWords = true)),
            'autor' => $this->faker->randomElement($usuarios),
            'titulo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'imagem_em_destaque' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'capa_do_evento' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'datas' => [
                $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = null),
                $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = null),
            ],
            'local' => $this->faker->address(),
            'conteudo' => $this->faker->text(),
        ];
    }
}
