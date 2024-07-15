<?php

namespace Tests\Feature;

use App\Models\Eventos;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventosTest extends TestCase
{
    public function test_listar_eventos()
    {
        \App\Models\Eventos::factory(10)->create();

        $response = $this->getJson('/api/eventos');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'slug',
                    'autor',
                    'imagem_em_destaque',
                    'capa_do_evento',
                    'datas',
                    'local',
                    'conteudo',
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_cadastrar_evento()
    {
        $usuario = Usuarios::factory()->create();
        $novoEvento = Eventos::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/eventos', $novoEvento);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('eventos', ['autor' => $novoEvento['autor']]);
    }

    public function test_editar_evento()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'titulo' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $eventoManipulado = \App\Models\Eventos::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/eventos/update/' . $eventoManipulado->slug, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_eventos()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $eventoManipulado = \App\Models\Eventos::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/eventos/delete/' . $eventoManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('eventos', ['id' => $eventoManipulado->id]);
    }
}
