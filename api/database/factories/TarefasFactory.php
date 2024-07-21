<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tarefas;

class TarefasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Tarefas::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();
        return [
            'administrador' => $this->faker->randomElement($usuarios),
            'executante' => $this->faker->randomElement($usuarios),
            'tarefa_a_ser_executada' => $this->faker->sentence(),
            'tarefa_concluida' => $this->faker->boolean,
        ];
    }
}
