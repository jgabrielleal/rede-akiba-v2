<?php

namespace Tests\Feature;

use App\Models\Materias;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MateriasTest extends TestCase
{
    public function test_listar_historico_no_ar()
    {
        \App\Models\Materias::factory(10)->create();

        $response = $this->getJson('/api/materias');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'slug',
                    'status',
                    'autor',
                    'imagem_em_destaque',
                    'capa_da_materia',
                    'titulo',
                    'conteudo',
                    'tags', 
                    'fontes_de_pesquisa',
                    'reacoes'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_recuperar_materia_especifica()
    {
        $materia = \App\Models\Materias::factory(10)->create();
        $materiaManipulada = $materia->first();
    
        $response = $this->getJson('/api/materias/' . $materiaManipulada->slug);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'slug',
            'status',
            'autor',
            'imagem_em_destaque',
            'capa_da_materia',
            'titulo',
            'conteudo',
            'tags', 
            'fontes_de_pesquisa',
            'reacoes'
        ]);
    }

    public function test_cadastrar_materias()
    {
        $usuario = Usuarios::factory()->create();
        $novaMateria = Materias::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/materias', $novaMateria);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
    }

    public function test_editar_materia()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'titulo' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $materiaManipulada = \App\Models\Materias::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/materias/update/' . $materiaManipulada->slug, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_materia()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $materiaManipulada = \App\Models\Materias::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/materias/delete/' . $materiaManipulada->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }
}
