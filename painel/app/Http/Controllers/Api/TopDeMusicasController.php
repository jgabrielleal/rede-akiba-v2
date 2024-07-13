<?php

namespace App\Http\Controllers\Api;

use App\Models\TopDeMusicas;
use App\Models\ListaDeMusicas;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TopDeMusicasController extends Controller
{
    use UploadImage;
    use RemoveImage;
    
    public function retornaTodosTopDeMusica()
    {
        try{
            $topDeMusicas = TopDeMusicas::with('musica')->paginate(10);

            if($topDeMusicas->isNotEmpty()){
                return response()->json($topDeMusicas, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum top de música encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function retornaTopDeMusicaEspecifico($id)
    {
        try{
            $topDeMusica = TopDeMusicas::where('id', $id)->first();

            if($topDeMusica !== null){
                $topDeMusica->load('musica');
                return response()->json($topDeMusica, 200);
            }else{
                return response()->json(['mensagem' => 'Top de música não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function cadastraTopDeMusica(Request $request)
    {
        try{
            $validacao = $request->validate([
                'musica' => 'required|exists:lista_de_musicas,id',
            ]);

            $TopDeMusica = TopDeMusicas::create([
                'musica' => $request->musica,
            ]);

            return response()->json($TopDeMusica, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function atualizaTopDeMusicaEspecifico(Request $request, $id)
    {
        try{
            $topDeMusica = TopDeMusicas::where('id', $id)->first();

            if(!$topDeMusica){
                return response()->json(['mensagem' => 'Top de música não encontrado'], 404);
            }

            $validacao = $request->validate([
                'avatar' =>  'image|mimes:jpeg,png,jpg,gif',
                'musica' => 'exists:lista_de_musicas,id',
            ]);

            $camposAtualizaveis = [
                'avatar',
                'musica'
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    switch($campo){
                        case 'avatar':                    
                            $this->RemoveImage($topDeMusica, 'avatar');
                            $topDeMusica->avatar = $this->UploadImage($request, 'avatar');
                        break;
                        default: 
                            $topDeMusica->$campo = $request->$campo;
                        break;
                    }
                }
            }

            $topDeMusica->save();
            return response()->json($topDeMusica, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function removerTopDeMusicaEspecifico($id)
    {
        try{
            $topDeMusica = TopDeMusicas::where('id', $id)->first();

            if(!$topDeMusica){
                return response()->json(['mensagem' => 'Top de música não encontrado'], 404);
            }

            $this->RemoveImage($topDeMusica, 'avatar');

            $topDeMusica->delete();
            return response()->json(['mensagem' => 'Top de música removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }
}
