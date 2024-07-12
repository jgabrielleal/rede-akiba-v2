<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => Str::slug($this->faker->userName()),
            'ativo' => $this->faker->boolean(),
            'login' => $this->faker->unique()->userName(),
            'senha' => $this->faker->password(),
            'niveis_de_acesso' => $this->faker->randomElement(['administrador', 'redator', 'locutor', 'cdc']),
            'avatar' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'nome' => $this->faker->name(),
            'apelido' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'idade' => $this->faker->numberBetween(18, 100),
            'cidade' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'pais' => $this->faker->country(),
            'biografia' => $this->faker->text(),
            'redes_sociais' => [
                'facebook' => $this->faker->url(),
                'twitter' => $this->faker->url(),
                'instagram' => $this->faker->url(),
                'linkedin' => $this->faker->url(),
                'youtube' => $this->faker->url(),
            ],
            'gostos' => [
                'musica' => $this->faker->word(),
                'filme' => $this->faker->word(),
                'comida' => $this->faker->word(),
                'bebida' => $this->faker->word(),
                'hobby' => $this->faker->word(),
            ],
        ];
    }
}
