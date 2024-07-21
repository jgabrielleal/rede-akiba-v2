<?php

namespace Tests\Feature\Api;

use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    public function test_listar_usuarios()
    {
        \App\Models\Usuarios::factory(10)->create();

        $response = $this->getJson('/api/usuarios');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'slug',
                    'ativo',
                    'login',
                    'senha',
                    'niveis_de_acesso',
                    'avatar',
                    'nome',
                    'apelido',
                    'email',
                    'idade',
                    'cidade',
                    'estado',
                    'pais',
                    'biografia',
                    'redes_sociais',
                    'gostos',
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_recuperar_usuario_especifico()
    {
        $usuario = \App\Models\Usuarios::factory(10)->create();
        $usuarioManipulado = $usuario->first();
    
        $response = $this->getJson('/api/usuarios/' . $usuarioManipulado->slug);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'slug',
            'ativo',
            'login',
            'senha',
            'niveis_de_acesso',
            'avatar',
            'nome',
            'apelido',
            'email',
            'idade',
            'cidade',
            'estado',
            'pais',
            'biografia',
            'redes_sociais',
            'gostos',
        ]);
    }

    public function test_cadastrar_usuario()
    {
        $usuario = Usuarios::factory()->create();
        $novoUsuario = Usuarios::factory()->make()->toArray();

        $response = $this->actingAs($usuario, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('POST', '/api/usuarios', $novoUsuario);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
    }

    public function test_editar_usuario()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'avatar' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
            'nome' => $faker->firstName,
            'apelido' => $faker->firstName,
            'email' => $faker->email,
            'idade' => $faker->numberBetween(18, 100),
            'cidade' => $faker->city,
            'estado' => $faker->state,
            'pais' => $faker->country,
            'biografia' => $faker->text,
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $usuarioManipulado = \App\Models\Usuarios::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/usuarios/update/' . $usuarioManipulado->slug, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_usuario()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $usuarioManipulado = \App\Models\Usuarios::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/usuarios/delete/' . $usuarioManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }
}
