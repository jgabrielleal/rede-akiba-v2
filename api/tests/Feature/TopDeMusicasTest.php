<?php

namespace Tests\Feature;

use App\Models\TopDeMusicas;
use App\Models\ListaDeMusicas;
use App\Models\PedidosMusicais;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopDeMusicasTest extends TestCase
{
    public function test_listar_top_de_musicias()
    {
        \App\Models\ListaDeMusicas::factory(10)->create();
        \App\Models\TopDeMusicas::factory(10)->create();

        $response = $this->getJson('/api/topdemusicas');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'avatar',
                    'musica'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_recuperar_posicao_do_top_de_musica_especifico()
    {
        $posicao = \App\Models\TopDeMusicas::factory(10)->create();
        $posicaoManipulada = $posicao->first();
    
        $response = $this->getJson('/api/topdemusicas/' . $posicaoManipulada->id);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'avatar',
            'musica'
        ]);
    }

    public function test_cadastrar_posicao_top_de_musica()
    {
        $usuario = Usuarios::factory()->create();
        $novaPosicao = TopDeMusicas::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/topdemusicas', $novaPosicao);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('top_de_musicas', ['musica' => $novaPosicao['musica']]);
    }

    public function test_editar_posicao_top_de_musicas()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'avatar' => \Illuminate\Http\UploadedFile::fake()->image('imagem.jpg'),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $topDeMusicaManipulado = \App\Models\TopDeMusicas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/topdemusicas/update/' . $topDeMusicaManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_posicao_top_de_musica()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $topDeMusicaManipulado = \App\Models\TopDeMusicas::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/topdemusicas/delete/' . $topDeMusicaManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }
}
