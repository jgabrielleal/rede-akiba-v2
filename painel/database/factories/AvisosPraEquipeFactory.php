<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\AvisosPraEquipe;

class AvisosPraEquipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = AvisosPraEquipe::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'rementente' => $this->faker->randomElement($usuarios),
            'destinatario' => $this->faker->randomElement($usuarios),
            'mensagem' => $this->faker->text(),
        ];
    }
}
