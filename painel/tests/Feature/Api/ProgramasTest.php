<?php

namespace Tests\Feature\Api;

use App\Models\Programas;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgramasTest extends TestCase
{
    public function test_listar_programas()
    {
        \App\Models\Programas::factory(10)->create();

        $response = $this->getJson('/api/programas');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'slug',
                    'locutor',
                    'nome_do_programa',
                    'logo_do_programa',
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_criar_programa()
    {
        $usuario = Usuarios::factory()->create();
        $novoPrograma = Programas::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/programas', $novoPrograma);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('programas', ['nome_do_programa' => $novoPrograma['nome_do_programa']]);
    }

    public function test_editar_programa()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'nome_do_programa' => $faker->firstName,
            'logo_do_programa' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $programaManipulado = \App\Models\Programas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/programas/update/' . $programaManipulado->slug, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_programa()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $programaManipulado = \App\Models\Programas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/programas/delete/' . $programaManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('programas', ['id' => $programaManipulado->id]);
    }
}
