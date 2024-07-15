<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Materias;

class MateriasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Materias::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'slug' =>  Str::slug($this->faker->sentence($nbWords = 6, $variableNbWords = true)),
            'publicado' => $this->faker->boolean,
            'autor' => $this->faker->randomElement($usuarios),
            'imagem_em_destaque' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'capa_da_materia' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'titulo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'conteudo' => $this->faker->text(),
            'tags' => $this->faker->randomElement(['anime', 'mangá', 'review']),
            'fontes_de_pesquisa' => [
                'nome' => $this->faker->name,
                'endereco' => $this->faker->url,
            ],
            'reacoes' => [
                'gostei' => $this->faker->numberBetween(0, 100),
                'amei' => $this->faker->numberBetween(0, 100),
                'surpreso' => $this->faker->numberBetween(0, 100),
                'triste' => $this->faker->numberBetween(0, 100),
                'raiva' => $this->faker->numberBetween(0, 100),
            ],
        ];
    }
}
