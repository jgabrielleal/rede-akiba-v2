<?php

namespace Tests\Feature;

use App\Models\BatalhaDePlaylist;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BatalhaDePlaylistTest extends TestCase
{
    public function test_retornar_batalha_de_playlist()
    {
        \App\Models\BatalhaDePlaylist::factory(1)->create();

        $response = $this->getJson('/api/batalhadeplaylist');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'imagem',
            'primeiro_competidor',
            'segundo_competidor',
        ]);
    

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_editar_batalha_de_playlist()
    {
        $faker = \Faker\Factory::create();

        $primeiroCompetidor = \App\Models\Usuarios::factory()->create();
        $segundoCompetidor = \App\Models\Usuarios::factory()->create();
        
        $dados = [
            'primeiro_competidor' => $primeiroCompetidor->id,
            'segundo_competidor' => $segundoCompetidor->id,
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $batalhaManipulada = \App\Models\BatalhaDePlaylist::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/batalhadeplaylist/update/', $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }


}
