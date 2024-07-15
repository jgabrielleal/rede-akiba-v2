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

    protected $model = Eventos::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'slug' =>  Str::slug($this->faker->sentence()),
            'autor' => $this->faker->randomElement($usuarios),
            'titulo' => $this->faker->sentence(),
            'imagem_em_destaque' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'capa_do_evento' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'datas' => $this->faker->date(),
            'local' => $this->faker->address(),
            'conteudo' => $this->faker->text(),
        ];
    }
}
