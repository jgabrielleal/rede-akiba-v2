<?php

namespace Tests\Feature;

use App\Models\OuvinteDoMes;
use App\Models\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OuvinteDoMesTest extends TestCase
{
    public function test_retornar_ouvinte_do_mes()
    {
        \App\Models\OuvinteDoMes::factory(1)->create();

        $response = $this->getJson('/api/ouvintedomes');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'nome',
            'endereco',
            'avatar',
            'quantidade_de_pedidos',
            'programa_favorito'
        ]);
    
        if ($response->status() !== 200) {
            $this->fail('Expected status code 200 but received ' . $response->status() . '. Response: ' . $response->getContent());
        }
    }
}
