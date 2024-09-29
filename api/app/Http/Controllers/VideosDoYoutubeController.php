<?php

namespace App\Http\Controllers;;

use App\Models\VideosDoYoutube;
use Illuminate\Http\Request;

class VideosDoYoutubeController extends Controller
{
    public function retornaTodosVideos()
    {
        $videos = VideosDoYoutube::with(['autor'])->paginate(10);

        if ($videos->isNotEmpty()) {
            return response()->json($videos, 200);
        }
            
        return response()->noContent();
    }

    public function retornaVideoEspecifico($id)
    {
        $video = VideosDoYoutube::where('id', $id)->first();

        if ($video !== null) {
            $video->load('autor');

            return response()->json($video, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraVideo(Request $request)
    {
        $request->validate([
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
    }

    public function atualizaVideoEspecifico(Request $request, $id)
    {
        $video = VideosDoYoutube::where('id', $id)->first();

        if (!$video) {
            return response()->noContent();
        }

        $request->validate([
            'titulo_do_video' => 'required',
            'identificador_do_video' => 'required',
        ]);

        $update = [
            'titulo_do_video' => $request->titulo_do_video,
            'identificador_do_video' => $request->identificador_do_video,
        ];

        $video->update($update);
        return response()->json($video, 200);
    }

    public function removerVideoEspecifico($id)
    {
        $video = VideosDoYoutube::find($id);

        if (!$video) {
            return response()->noContent();
        }

        $video->delete();
        return response()->json(['mensagem' => 'Vídeo removido com sucesso'], 200);
    }
}
