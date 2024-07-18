<?php

namespace Tests\Feature;

use App\Models\PedidosMusicais;
use App\Models\Programas;
use App\Models\ListaDeMusicas;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidosMusicaisTest extends TestCase
{
    public function test_listar_pedidos_musicais()
    {
        \App\Models\ListaDeMusicas::factory(10)->create();
        \App\Models\Programas::factory(10)->create();
        \App\Models\PedidosMusicais::factory(10)->create();

        $response = $this->getJson('/api/pedidosmusicais');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 
                '*' => [ 
                    'id',
                    'apelido_do_ouvinte',
                    'endereco_do_ouvinte',
                    'recado_para_o_locutor',
                    'programa_no_ar',
                    'musica_pedida'
                ]
            ]
        ]);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }

    public function test_recuperar_pedido_musical_especifico()
    {
        $pedidoMusical = \App\Models\PedidosMusicais::factory(10)->create();
        $pedidoMusicalManipulado = $pedidoMusical->first();
    
        $response = $this->getJson('/api/pedidosmusicais/' . $pedidoMusicalManipulado->id);
        $response->assertStatus(200);
    
        $response->assertJsonStructure([
            'id',
            'apelido_do_ouvinte',
            'endereco_do_ouvinte',
            'recado_para_o_locutor',
            'programa_no_ar',
            'musica_pedida'
        ]);
    }

    public function test_cadastrar_pedido_musical()
    {
        $usuario = Usuarios::factory()->create();
        $novoPedido = PedidosMusicais::factory()->make()->toArray();
    
        $response = $this->actingAs($usuario, 'sanctum')
        ->withHeader('Accept', 'application/json')
        ->json('POST', '/api/pedidosmusicais', $novoPedido);

        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }

        $response->assertStatus(200);
    }

    public function test_editar_pedido_musical()
    {
        $faker = \Faker\Factory::create();

        $dados = [
            'recado_para_o_locutor' => $faker->text(),
        ];
    
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $pedidoMusicalManipulado = \App\Models\PedidosMusicais::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('PATCH', '/api/pedidosmusicais/update/' . $pedidoMusicalManipulado->id, $dados);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }

    public function test_remover_pedido_musical()
    {
        $usuarioAutenticado = \App\Models\Usuarios::factory()->create();
        $pedidoMusicalManipulado = \App\Models\PedidosMusicais::factory()->create();
    
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
                    ->withHeader('Accept', 'application/json')
                    ->json('DELETE', '/api/pedidosmusicais/delete/' . $pedidoMusicalManipulado->id);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    
        $response->assertStatus(200);
    }
}
