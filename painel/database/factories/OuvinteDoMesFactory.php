<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\OuvinteDoMes;

class OuvinteDoMesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = OuvinteDoMes::class;

    public function definition()
    {
        $programas = \App\Models\Programas::pluck('id')->toArray();

        return [
            'nome' => $this->faker->name(),
            'endereco' => $this->faker->address(),
            'avatar' =>  \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg'),
            'quantidade_de_pedidos' => $this->faker->numberBetween($min = 1, $max = 100),
            'programa_favorito' => $this->faker->randomElement($programas),
        ];
    }
}
