<?php

namespace App\Http\Controllers;

use App\Models\VideosDoYoutube;
use App\Models\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideosDoYoutubeController extends Controller
{
    public function retornaTodosVideos()
    {
        try{
            $videos = VideosDoYoutube::with(['autor'])->paginate(10);

            if($videos->isNotEmpty()){
                return response()->json($videos, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum vídeo encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaVideoEspecifico($id)
    {
        try{
            $video = VideosDoYoutube::where('id', $id)->first();

            if($video !== null){
                $video->load('autor');
                return response()->json($video, 200);
            }else{
                return response()->json(['mensagem' => 'Vídeo não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraVideo(Request $request)
    {
        try{
            $validacao = $request->validate([
                'autor' => 'required|exists:usuarios,id',
                'titulo_do_video' => 'required',
                'identificador_do_video' => 'required',
            ]);

            $video = VideosDoYoutube::create([
                'autor' => $request->autor,
                'titulo_do_video' => $request->titulo_do_video,
                'identificador_do_video' => $request->identificador_do_video,
            ]);

            return response()->json($video, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function atualizaVideoEspecifico(Request $request, $id)
    {
        try{
            $video = VideosDoYoutube::where('id', $id)->first();

            if(!$video){
                return response()->json(['mensagem' => 'Vídeo não encontrado'], 404);
            }

            $validacao = $request->validate([
                'autor' => 'exists:usuarios,id',
            ]);

            $camposAtualizaveis = [
                'autor',
                'titulo_do_video',
                'identificador_do_video'
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    $video->$campo = $request->$campo;
                }
            }

            $video->save();
            return response()->json($video, 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerVideoEspecifico($id)
    {
        try{
            $video = VideosDoYoutube::find($id);

            if(!$video){
                return response()->json(['mensagem' => 'Vídeo não encontrado'], 404);
            }

            $video->delete();
            return response()->json(['mensagem' => 'Vídeo removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
