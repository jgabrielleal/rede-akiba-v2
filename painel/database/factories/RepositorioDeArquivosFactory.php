<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\RepositorioDeArquivos;

class RepositorioDeArquivosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = RepositorioDeArquivos::class;

    public function definition()
    {
        $usuarios = \App\Models\Usuarios::pluck('id')->toArray();
        
        return [
            'uploader' => $this->faker->randomElement($usuarios),
            'nome_do_arquivo' => $this->faker->sentence(),
            'icone_do_arquivo' =>  \Illuminate\Http\UploadedFile::fake()->image('icon.jpg'),
            'endereco_de_download' => $this->faker->url(),
            'categoria' => $this->faker->randomElement(['Softwares', 'Pacotes', 'Outro']),
        ];
    }
}
