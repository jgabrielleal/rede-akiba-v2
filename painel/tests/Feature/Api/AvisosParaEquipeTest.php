<?php

namespace Tests\Feature;

use App\Models\AvisosParaEquipe;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AvisosParaEquipeTest extends TestCase
{
    public function test_listar_avisos()
    {
        \App\Models\AvisosParaEquipe::factory(10)->create();

        $response = $this->getJson('/api/avisos');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'remetente',
                    'destinatario',
                    'mensagem',
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_cadastrar_avisos()
    {
        $usuario = Usuarios::factory()->create();
        $avisoManipulado = AvisosParaEquipe::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/avisos', $avisoManipulado);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('avisos_para_equipe', ['remetente' => $avisoManipulado['remetente']]);
    }

    public function test_editar_aviso()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'mensagem' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $avisoManipulado = \App\Models\AvisosParaEquipe::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/avisos/update/' . $avisoManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_aviso()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $avisoManipulado = \App\Models\AvisosParaEquipe::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/avisos/delete/' . $avisoManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('avisos_para_equipe', ['id' => $avisoManipulado->id]);
    }
}
