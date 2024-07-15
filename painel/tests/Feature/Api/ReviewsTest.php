<?php

namespace Tests\Feature;

use App\Models\Reviews;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewsTest extends TestCase
{
    public function test_listar_reviews()
    {
        \App\Models\Reviews::factory(10)->create();

        $response = $this->getJson('/api/reviews');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'slug',
                    'autor',
                    'imagem_em_destaque',
                    'capa_da_review',
                    'titulo',
                    'sinopse',
                    'conteudo',
                    'reacoes'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_cadastrar_review()
    {
        $usuario = Usuarios::factory()->create();
        $novoReview = Reviews::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/reviews', $novoReview);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('reviews', ['autor' => $novoReview['autor']]);
    }

    public function test_editar_review()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'titulo' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $reviewManipulado = \App\Models\Reviews::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/reviews/update/' . $reviewManipulado->slug, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_review()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $reviewManipulado = \App\Models\Reviews::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/reviews/delete/' . $reviewManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('reviews', ['id' => $reviewManipulado->id]);
    }
}
