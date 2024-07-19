<?php

namespace Tests\Feature;

use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutenticacaoTest extends TestCase
{
    public function test_usuario_logado()
    {
        $usuario = Usuarios::factory()->create();
        $token = $usuario->createToken('testToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->getJson('/api/autenticacao/logged');

        $response->assertStatus(200)
                 ->assertJson(['id' => $usuario->id]);
    }

    public function test_deslogar_usuario()
    {
        $usuario = Usuarios::factory()->create();
        $token = $usuario->createToken('testToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson('/api/autenticacao/logout');

        $response->assertStatus(200)
                 ->assertJson(['mensagem' => 'Usuário deslogado com sucesso']);
    }
}
