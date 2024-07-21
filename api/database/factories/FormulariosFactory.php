<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Formularios;

class FormulariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Formularios::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'ultima_visualizacao' => $this->faker->randomElement($usuarios),
            'tipo_de_formulario' => $this->faker->randomElement(['contato', 'recrutamento', 'parceria', 'anuncio']),
            'conteudo_do_formulario' => [
                'nome' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'telefone' => $this->faker->phoneNumber(),
                'mensagem' => $this->faker->sentence(),
            ]
        ];
    }
}
