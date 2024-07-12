<?php

namespace App\Http\Controllers\Api;

use App\Models\PedidosMusicais;
use App\Models\NoAr;
use App\Models\ListaDeMusicas;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PedidosMusicaisController extends Controller
{
    public function retornaTodosPedidosMusicais()
    {
        try{
            $pedidos = PedidosMusicais::where('programa_no_ar', 'musica_pedida')->paginate(10);

            if($pedidos->isNotEmpty()){
                return response()->json($pedidos, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum pedido musical encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function retornaPedidoMusicalEspecifico($id)
    {
        try{
            $pedido = PedidosMusicais::where('id', $id)->first();

            if($pedido !== null){
                $pedido->load('programa_no_ar');
                $pedido->load('musica_pedida');
                return response()->json($pedido, 200);
            }else{
                return response()->json(['mensagem' => 'Pedido musical não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function cadastraPedidoMusical(Request $request)
    {
        try{
            $validacao = $request->validate([
                'apelido_do_ouvinte' => 'required',
                'endereco_do_ouvinte' => 'required',
                'recado_para_o_locutor' => 'required',
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
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function atualizaPedidoMusicalEspecifico(Request $request, $id)
    {
        try{
            $pedido = PedidosMusicais::where('id', $id)->first();

            if(!$pedido){
                return response()->json(['mensagem' => 'Pedido musical não encontrado'], 404);
            }

            $validacao = $request->validate([
                'programa_no_ar' => 'exists:no_ar,id',
                'musica_pedida' => 'exists:lista_de_musicas,id',
            ]);

            $camposAtualizaveis = [
                'apelido_do_ouvinte',
                'endereco_do_ouvinte',
                'recado_para_o_locutor',
                'programa_no_ar',
                'musica_pedida',
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    $pedido->$campo = $request->$campo;
                }
            }

            $pedido->save();
            return response()->json($pedido, 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function removerPedidoMusicalEspecifico($id)
    {
        try{
            $pedido = PedidosMusicais::find($id);

            if(!$pedido){
                return response()->json(['mensagem' => 'Pedido musical não encontrado'], 404);
            }

            $pedido->delete();
            return response()->json(['mensagem' => 'Pedido musical deletado com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }
}
