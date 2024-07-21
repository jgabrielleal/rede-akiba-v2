<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ListaDeMusicas;

class ListaDeMusicasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = ListaDeMusicas::class;
    
    public function definition()
    {
        return [
            'numero_de_vezes_tocada' => $this->faker->numberBetween(0, 100),
            'nome_do_anime' => $this->faker->sentence(),
            'nome_da_musica' => $this->faker->sentence(),
            'nome_do_artista' => $this->faker->name(),
            'nome_do_album' => $this->faker->sentence(),
            'ano_de_lancamento' => $this->faker->year(),
        ];
    }
}
