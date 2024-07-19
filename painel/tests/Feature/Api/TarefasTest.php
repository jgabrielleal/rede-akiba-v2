<?php

namespace Tests\Feature;

use App\Models\Tarefas;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TarefasTest extends TestCase
{
    public function test_listar_tarefas()
    {
        \App\Models\Tarefas::factory(10)->create();

        $response = $this->getJson('/api/tarefas');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'administrador',
                    'executante',
                    'tarefa_a_ser_executada',
                    'tarefa_concluida'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_recuperar_tarefa()
    {
        $tarefa = \App\Models\Tarefas::factory(10)->create();
        $tarefaManipulada = $tarefa->first();
    
        $response = $this->getJson('/api/tarefas/' . $tarefaManipulada->id);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'administrador',
            'executante',
            'tarefa_a_ser_executada',
            'tarefa_concluida'
        ]);
    }

    public function test_cadastrar_tarefa()
    {
        $usuario = Usuarios::factory()->create();
        $novaTarefa = Tarefas::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/tarefas', $novaTarefa);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
    }

    public function test_editar_tarefa()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'tarefa_a_ser_executada' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $tarefaManipulada = \App\Models\Tarefas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/tarefas/update/' . $tarefaManipulada->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_tarefa()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $tarefaManipulada = \App\Models\Tarefas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/tarefas/delete/' . $tarefaManipulada->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }
}
