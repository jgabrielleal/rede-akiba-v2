<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PedidosMusicais;

class PedidosMusicaisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = PedidosMusicais::class;
    
    public function definition()
    {
        $programas = \App\Models\Programas::pluck('id')->toArray();
        $listaDeMusicas = \App\Models\ListaDeMusicas::pluck('id')->toArray();

        return [
            'apelido_do_ouvinte' => $this->faker->name,
            'endereco_do_ouvinte' => $this->faker->address,
            'recado_para_o_locutor' => $this->faker->sentence,
            'programa_no_ar' => $this->faker->randomElement($programas),
            'musica_pedida' => $this->faker->randomElement($listaDeMusicas),
        ];
    }
}
