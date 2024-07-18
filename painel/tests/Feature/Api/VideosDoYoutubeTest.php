<?php

namespace Tests\Feature;

use App\Models\VideosDoYoutube;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideosDoYoutubeTest extends TestCase
{
    public function test_listar_videos()
    {
        \App\Models\VideosDoYoutube::factory(10)->create();

        $response = $this->getJson('/api/videos');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'autor',
                    'titulo_do_video',
                    'identificador_do_video'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

    }


    public function test_recuperar_video_especifico()
    {
        $videos = \App\Models\VideosDoYoutube::factory(10)->create();
        $videoManipulado = $videos->first();
    
        $response = $this->getJson('/api/videos/' . $videoManipulado->id);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'autor',
            'titulo_do_video',
            'identificador_do_video'
        ]);
    }

    public function test_cadastrar_video()
    {
        $usuario = Usuarios::factory()->create();
        $videoManipulado = VideosDoYoutube::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/videos', $videoManipulado);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
    }

    public function test_editar_video()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'titulo_do_video' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $videoManipulado = \App\Models\VideosDoYoutube::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/videos/update/' . $videoManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_video()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $videoManipulado = \App\Models\VideosDoYoutube::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/videos/delete/' . $videoManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

}
