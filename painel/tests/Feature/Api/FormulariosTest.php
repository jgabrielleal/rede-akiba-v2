<?php

namespace Tests\Feature;

use App\Models\Formularios;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormulariosTest extends TestCase
{
    public function test_listar_formularios()
    {
        \App\Models\Formularios::factory(10)->create();

        $response = $this->getJson('/api/formularios');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'ultima_visualizacao',
                    'tipo_de_formulario',
                    'conteudo_do_formulario',
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_recuperar_formulario_especifico()
    {
        $formulario = \App\Models\Formularios::factory(10)->create();
        $formularioManipulado = $formulario->first();
    
        $response = $this->getJson('/api/formularios/' . $formularioManipulado->id);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'ultima_visualizacao',
            'tipo_de_formulario',
            'conteudo_do_formulario',
        ]);
    }

    public function test_cadastrar_formulario()
    {
        $usuario = Usuarios::factory()->create();
        $novoFormulario = Formularios::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/formularios', $novoFormulario);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
    }

    public function test_editar_formulario()
    {
        $faker = \Faker\Factory::create();

        $ultimaVisualizacao = \App\Models\Usuarios::factory()->create();

        $dados = [
            'ultima_visualizacao' => $ultimaVisualizacao->id,
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $formularioManipulado = \App\Models\Formularios::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/formularios/update/' . $formularioManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_formulario()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $formularioManipulado = \App\Models\Formularios::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/formularios/delete/' . $formularioManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }
}
