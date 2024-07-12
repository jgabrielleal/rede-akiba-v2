<?php

namespace App\Http\Controllers\Api;

use App\Models\BatalhaDePlaylist;
use App\Models\Usuarios;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BatalhaDePlaylistController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaBatalhaDePlaylistEspecifica()
    {
        try{
            $batalha = BatalhaDePlaylist::where('id', 1)->first();

            if($batalha !== null){
                $batalha->load('primeiro_competidor');
                $batalha->load('segundo_competidor');
                return response()->json($batalha, 200);
            }else{
                return response()->json(['mensagem' => 'Batalha não encontrada'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function atualizaBatalhaDePlaylistEspecifica(Request $request)
    {
        try{
            $batalha = BatalhaDePlaylist::where('id', 1)->first();

            if(!$batalha){
                return response()->json(['mensagem' => 'Batalha não encontrada'], 404);
            }

            $validacao = $request->validate([
                'imagem' => 'image|mimes:jpeg,png,jpg,gif',
                'primeiro_competidor' => 'required|exists:usuarios,id',
                'segundo_competidor' => 'required|exists:usuarios,id',
            ]);

            $camposAtualizaveis = [
                'imagem',
                'primeiro_competidor',
                'segundo_competidor',
            ];  

            foreach($camposAtualizaveis as $campo){
                if(isset($validacao[$campo])){
                    if($campo == 'imagem'){
                        $this->removeImage($batalha, 'imagem');
                        $batalha->$campo = $this->uploadImage($request, 'imagem');
                    }else{
                        $batalha->$campo = $request->$campo;
                    }
                }
            }
            
            $batalha->save();
            return response()->json($batalha, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }
}
