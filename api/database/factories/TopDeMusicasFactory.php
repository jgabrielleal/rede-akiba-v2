<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\TopDeMusicas;

class TopDeMusicasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = TopDeMusicas::class;
    
    public function definition()
    {
        $listaDeMusicas = \App\Models\listaDeMusicas::pluck('id')->toArray();

        return [
            'avatar' => \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg'),
            'musica' => $this->faker->randomElement($listaDeMusicas),
        ];
    }
}
