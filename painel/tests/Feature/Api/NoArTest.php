<?php

namespace Tests\Feature;

use App\Models\NoAr;
use App\Models\Programas;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoArTest extends TestCase
{
    public function test_listar_historico_no_ar()
    {
        \App\Models\NoAr::factory(10)->create();

        $response = $this->getJson('/api/noar');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'programa',
                    'controle_de_pedidos',
                    'tipo_de_transmissao',
                    'data_da_transmissao',
                    'inicio_da_transmissao',
                    'fim_da_transmissao'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_cadastrar_registro_no_historico_no_ar()
    {
        $usuario = Usuarios::factory()->create();
        $novoRegistro = NoAr::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/noar', $novoRegistro);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('no_ar', ['programa' => $novoRegistro['programa']]);
    }

    public function test_editar_registro_do_historico_no_ar()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'inicio_da_transmissao' => $faker->time(),
            'fim_da_transmissao' => $faker->time(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $registroManipulado = \App\Models\NoAr::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/noar/update/' . $registroManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_registro_do_historico_no_ar()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $registroManipulado = \App\Models\NoAr::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/noar/delete/' . $registroManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('no_ar', ['id' => $registroManipulado->id]);
    }
}
