<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\NoAr;

class NoArFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = NoAr::class;

    public function definition()
    {
        $programas = \App\Models\Programas::pluck('id')->toArray();

        return [
            'programa' => $this->faker->randomElement($programas),
            'controle_de_pedidos' => $this->faker->randomElement([0, 1]),
            'tipo_de_transmissao' => $this->faker->randomElement(['ao_vivo', 'gravado', 'automatizado']),
            'data_da_transmissao' => $this->faker->date(),
            'inicio_da_transmissao' => $this->faker->time(),
            'fim_da_transmissao' => $this->faker->time(),
        ];
    }
}
