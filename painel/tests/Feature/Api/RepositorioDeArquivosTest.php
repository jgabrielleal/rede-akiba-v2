<?php

namespace Tests\Feature;

use App\Models\RepositorioDeArquivos;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositorioDeArquivosTest extends TestCase
{
    public function test_listar_arquivos_do_repositorio()
    {
        \App\Models\RepositorioDeArquivos::factory(10)->create();

        $response = $this->getJson('/api/repositorio');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'uploader',
                    'nome_do_arquivo',
                    'icone_do_arquivo',
                    'endereco_de_download',
                    'categoria'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $this->assertCount(10, $response->json('data'));
    }

    public function test_cadastrar_arquivo_no_repositorio()
    {
        $usuario = Usuarios::factory()->create();
        $novoArquivo = RepositorioDeArquivos::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/repositorio', $novoArquivo);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
        $this->assertDatabaseHas('repositorio_de_arquivos', ['uploader' => $novoArquivo['uploader']]);
    }

    public function test_editar_arquivo_no_repositorio()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'nome_do_arquivo' => $faker->sentence(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $arquivoManipulado = \App\Models\RepositorioDeArquivos::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/repositorio/update/' . $arquivoManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_arquivo_do_repositorio()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $arquivoManipulado = \App\Models\RepositorioDeArquivos::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/repositorio/delete/' . $arquivoManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
        $this->assertDatabaseMissing('repositorio_de_arquivos', ['id' => $arquivoManipulado->id]);
    }
}
