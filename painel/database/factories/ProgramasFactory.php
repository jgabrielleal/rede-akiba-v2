<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Programas;

class ProgramasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Programas::class;
    
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();

        return [
            'slug' => Str::slug($this->faker->name()),
            'locutor' => $this->faker->randomElement($usuarios),
            'nome_do_programa' => $this->faker->unique()->name(),
            'logo_do_programa' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
        ];
    }
}
