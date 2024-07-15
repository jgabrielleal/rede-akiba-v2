<?php

namespace App\Http\Controllers\Api;

use App\Models\ListaDeMusicas;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ListaDeMusicasController extends Controller
{
    public function retornaTodasMusicas()
    {
        try{
            $musicas = ListaDeMusicas::paginate(10);

            if($musicas->isNotEmpty()){
                return response()->json($musicas, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhuma música encontrada'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaMusicaEspecifica($id)
    {
        try{
            $musica = ListaDeMusicas::where('id', $id)->first();

            if($musica !== null){
                return response()->json($musica, 200);
            }else{
                return response()->json(['mensagem' => 'Música não encontrada'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraMusica(Request $request)
    {
        try{
            $validacao = $request->validate([
                'nome_do_anime' => 'required',
                'nome_da_musica' => 'required',
                'nome_do_artista' => 'required',
                'nome_do_album' => 'required',
                'ano_de_lancamento' => 'required',
            ]);

            $musica = ListaDeMusicas::create([
                'nome_do_anime' => $request->nome_do_anime,
                'nome_da_musica' => $request->nome_da_musica,
                'nome_do_artista' => $request->nome_do_artista,
                'nome_do_album' => $request->nome_do_album,
                'ano_de_lancamento' => $request->ano_de_lancamento
            ]);

            return response()->json($musica, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function atualizaMusicaEspecifica(Request $request, $id)
    {
        try{
            $musica = ListaDeMusicas::where('id', $id)->first();

            if(!$musica){
                return response()->json(['mensagem' => 'Música não encontrada'], 404);
            }

            $camposAtualizaveis = [
                'numero_de_vezes_tocada',
                'nome_do_anime',
                'nome_da_musica',
                'nome_do_artista',
                'nome_do_album',
                'ano_de_lancamento',
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    $musica->$campo = $request->$campo;
                }
            }

            $musica->save();
            return response()->json($musica, 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerMusicaEspecifica($id)
    {
        try{
            $musica = ListaDeMusicas::find($id);

            if(!$musica){
                return response()->json(['mensagem' => 'Música não encontrada'], 404);
            }

            $musica->delete();
            return response()->json(['mensagem' => 'Música deletada com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
