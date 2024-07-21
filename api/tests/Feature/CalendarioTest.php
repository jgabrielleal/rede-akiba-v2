<?php

namespace Tests\Feature;

use App\Models\Calendario;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarioTest extends TestCase
{
    public function test_listar_eventos_do_calendario()
    {
        \App\Models\Calendario::factory(10)->create();

        $response = $this->getJson('/api/calendario');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'data',
                    'hora',
                    'evento',
                    'designado',
                    'categoria'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_recuperar_evento_do_calendario_especifico()
    {
        $calendario = \App\Models\Calendario::factory(10)->create();
        $calendarioManipulado = $calendario->first();
    
        $response = $this->getJson('/api/calendario/' . $calendarioManipulado->id);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'data',
            'hora',
            'evento',
            'designado',
            'categoria'
        ]);
    }

    public function test_cadastrar_evento_no_calendario()
    {
        $usuario = Usuarios::factory()->create();
        $eventoManipulado = Calendario::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/calendario', $eventoManipulado);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
    }

    public function test_editar_evento_no_calendario()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'evento' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $eventoManipulado = \App\Models\Calendario::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/calendario/update/' . $eventoManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_evento_no_calendario()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $eventoManipulado = \App\Models\Calendario::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/calendario/delete/' . $eventoManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }
}
