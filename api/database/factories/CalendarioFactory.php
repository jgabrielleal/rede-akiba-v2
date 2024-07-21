<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Calendario;

class CalendarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Calendario::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'data' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'evento' => $this->faker->sentence(),
            'designado' => $this->faker->randomElement($usuarios),
            'categoria' => $this->faker->randomElement(['Podcast', 'Youtube', 'Programa', 'Outro']),
        ];
    }
}
