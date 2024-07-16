<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\AvisosParaEquipe;
use App\Models\Usuarios;

class AvisosParaEquipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AvisosParaEquipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Obtendo todos os IDs dos usuários
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'remetente' => $this->faker->randomElement($usuarios),
            'destinatario' => $this->faker->randomElement($usuarios),
            'mensagem' => $this->faker->sentence(),
        ];
    }
}
