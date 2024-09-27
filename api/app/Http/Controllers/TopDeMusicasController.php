<?php

namespace App\Http\Controllers;;

use App\Models\TopDeMusicas;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;

class TopDeMusicasController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosTopDeMusicas()
    {
        $topDeMusicas = TopDeMusicas::with(['musica'])->paginate(10);

        if ($topDeMusicas->isNotEmpty()) {
            return response()->json($topDeMusicas, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaTopDeMusicaEspecifico($id)
    {
        $topDeMusica = TopDeMusicas::where('id', $id)->first();

        if ($topDeMusica !== null) {
            $topDeMusica->load('musica');
            return response()->json($topDeMusica, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraTopDeMusica(Request $request)
    {
        $request->validate([
            'musica' => 'required|exists:lista_de_musicas,id',
        ]);

        $TopDeMusica = TopDeMusicas::create([
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
            'avatar' =>  'image|mimes:jpeg,png,jpg,gif',
            'musica' => 'exists:lista_de_musicas,id',
        ]);

        $camposAtualizaveis = [
            'avatar',
            'musica'
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                switch ($campo) {
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
    }

    public function removerTopDeMusicaEspecifico($id)
    {
        $topDeMusica = TopDeMusicas::where('id', $id)->first();

        if (!$topDeMusica) {
            return response()->noContent();
        }

        $this->RemoveImage($topDeMusica, 'avatar');

        $topDeMusica->delete();
        return response()->json(['mensagem' => 'Top de música removido com sucesso'], 200);
    }
}
