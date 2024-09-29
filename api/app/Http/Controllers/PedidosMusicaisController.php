<?php

namespace App\Http\Controllers;;

use App\Models\PedidosMusicais;
use Illuminate\Http\Request;

class PedidosMusicaisController extends Controller
{
    public function retornaTodosPedidosMusicais()
    {
        $pedidos = PedidosMusicais::with(['programa_no_ar', 'musica_pedida'])->paginate(10);

        if ($pedidos->isNotEmpty()) {
            return response()->json($pedidos, 200);
        }
            
        return response()->noContent();
    }

    public function retornaPedidoMusicalEspecifico($id)
    {
        $pedido = PedidosMusicais::where('id', $id)->first();

        if ($pedido !== null) {
            $pedido->load('programa_no_ar');
            $pedido->load('musica_pedida');

            return response()->json($pedido, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraPedidoMusical(Request $request)
    {
        $request->validate([
            'apelido_do_ouvinte' => 'required|string',
            'endereco_do_ouvinte' => 'required|string',
            'recado_para_o_locutor' => 'required|string',
            'programa_no_ar' => 'required|exists:no_ar,id',
            'musica_pedida' => 'required|exists:lista_de_musicas,id',
        ]);

        $pedido = PedidosMusicais::create([
            'apelido_do_ouvinte' => $request->apelido_do_ouvinte,
            'endereco_do_ouvinte' => $request->endereco_do_ouvinte,
            'recado_para_o_locutor' => $request->recado_para_o_locutor,
            'programa_no_ar' => $request->programa_no_ar,
            'musica_pedida' => $request->musica_pedida,
        ]);

        return response()->json($pedido, 200);
    }

    public function atualizaPedidoMusicalEspecifico(Request $request, $id)
    {
        $pedido = PedidosMusicais::where('id', $id)->first();

        if (!$pedido) {
            return response()->noContent();
        }

        $request->validate([
            'apelido_do_ouvinte' => 'required|string',
            'endereco_do_ouvinte' => 'required|string',
            'recado_para_o_locutor' => 'required|string',
            'programa_no_ar' => 'required|exists:no_ar,id',
            'musica_pedida' => 'required|exists:lista_de_musicas,id',
        ]);

        $update = [
            'apelido_do_ouvinte' => $request->apelido_do_ouvinte,
            'endereco_do_ouvinte' => $request->endereco_do_ouvinte,
            'recado_para_o_locutor' => $request->recado_para_o_locutor,
            'programa_no_ar' => $request->programa_no_ar,
            'musica_pedida' => $request->musica_pedida,
        ];

        $pedido->update($update);
        return response()->json($pedido, 200);
    }

    public function removerPedidoMusicalEspecifico($id)
    {
        $pedido = PedidosMusicais::find($id);

        if (!$pedido) {
            return response()->noContent();
        }

        $pedido->delete();
        return response()->json(['mensagem' => 'Pedido musical deletado com sucesso'], 200);
    }
}
