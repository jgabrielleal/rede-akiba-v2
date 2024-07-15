<?php

namespace Tests\Feature;

use App\Models\Podcasts;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PodcastsTest extends TestCase
{
    public function test_listar_podcasts()
    {
        \App\Models\Podcasts::factory(10)->create();

        $response = $this->getJson('/api/podcasts');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'slug',
                    'autor',
                    'temporada',
                    'episodio',
                    'titulo_do_episodio',
                    'capa_do_episodio',
                    'descricao_do_episodio',
                    'conteudo_da_publicacao',
                    'endereco_do_audio',
                    'agregadores',
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_cadastrar_podcast()
    {
        $usuario = Usuarios::factory()->create();
        $novoPodcast = Podcasts::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/podcasts', $novoPodcast);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('podcasts', ['autor' => $novoPodcast['autor']]);
    }

    public function test_editar_podcast()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'titulo_do_episodio' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $podcastManipulado = \App\Models\Podcasts::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/podcasts/update/' . $podcastManipulado->slug, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_podcast()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $podcastManipulado = \App\Models\Podcasts::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/podcasts/delete/' . $podcastManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('podcasts', ['id' => $podcastManipulado->id]);
    }
}
