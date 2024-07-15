<?php

namespace Tests\Feature;

use App\Models\ListaDeMusicas;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListaDeMusicasTest extends TestCase
{
    public function test_listar_musicas()
    {
        \App\Models\ListaDeMusicas::factory(10)->create();

        $response = $this->getJson('/api/musicas');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'numero_de_vezes_tocada',
                    'nome_do_anime',
                    'nome_da_musica',
                    'nome_do_artista',
                    'nome_do_album',
                    'ano_de_lancamento',
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_cadastrar_musica()
    {
        $usuario = Usuarios::factory()->create();
        $novaMusica = ListaDeMusicas::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/musicas', $novaMusica);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('lista_de_musicas', ['nome_da_musica' => $novaMusica['nome_da_musica']]);
    }

    public function test_editar_musica()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'nome_da_musica' => $faker->name(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $musicaManipulada = \App\Models\ListaDeMusicas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/musicas/update/' . $musicaManipulada->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_musica()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $musicaManipullada = \App\Models\ListaDeMusicas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/musicas/delete/' . $musicaManipullada->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('lista_de_musicas', ['id' => $musicaManipullada->id]);
    }
}
