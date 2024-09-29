<?php

namespace App\Http\Controllers;;

use App\Models\TopDeMusicas;

use Illuminate\Http\Request;

class TopDeMusicasController extends Controller
{
    public function retornaTodosTopDeMusicas()
    {
        $topDeMusicas = TopDeMusicas::with(['musica'])->paginate(10);

        if ($topDeMusicas->isNotEmpty()) {
            return response()->json($topDeMusicas, 200);
        }
            
        return response()->noContent();
    }

    public function retornaTopDeMusicaEspecifico($id)
    {
        $topDeMusica = TopDeMusicas::where('id', $id)->first();

        if ($topDeMusica !== null) {
            $topDeMusica->load('musica');

            return response()->json($topDeMusica, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraTopDeMusica(Request $request)
    {
        $request->validate([
            'avatar' => 'required|string',
            'musica' => 'required|exists:lista_de_musicas,id',
        ]);

        $TopDeMusica = TopDeMusicas::create([
            'avatar' => $request->avatar,
            'musica' => $request->musica,
        ]);

        return response()->json($TopDeMusica, 200);
    }

    public function atualizaTopDeMusicaEspecifico(Request $request, $id)
    {
        $topDeMusica = TopDeMusicas::where('id', $id)->first();

        if (!$topDeMusica) {
            return response()->noContent();
        }

        $request->validate([
            'avatar' =>  'required|string',
            'musica' => 'exists:lista_de_musicas,id',
        ]);

        $update = [
            'avatar' => $request->avatar,
            'musica' => $request->musica,
        ];

        $topDeMusica->update($update);
        return response()->json($topDeMusica, 200);
    }

    public function removerTopDeMusicaEspecifico($id)
    {
        $topDeMusica = TopDeMusicas::where('id', $id)->first();

        if (!$topDeMusica) {
            return response()->noContent();
        }

        $topDeMusica->delete();
        return response()->json(['mensagem' => 'Top de música removido com sucesso'], 200);
    }
}
