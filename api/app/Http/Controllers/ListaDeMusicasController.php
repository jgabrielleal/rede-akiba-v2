<?php

namespace App\Http\Controllers;;

use App\Models\ListaDeMusicas;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ListaDeMusicasController extends Controller
{
    public function retornaTodasMusicas()
    {
        $musicas = ListaDeMusicas::paginate(10);

        if ($musicas->isNotEmpty()) {
            return response()->json($musicas, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaMusicaEspecifica($id)
    {
        $musica = ListaDeMusicas::where('id', $id)->first();

        if ($musica !== null) {
            return response()->json($musica, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraMusica(Request $request)
    {
        $request->validate([
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
    }

    public function atualizaMusicaEspecifica(Request $request, $id)
    {
        $musica = ListaDeMusicas::where('id', $id)->first();

        if (!$musica) {
            return response()->noContent();
        }

        $camposAtualizaveis = [
            'numero_de_vezes_tocada',
            'nome_do_anime',
            'nome_da_musica',
            'nome_do_artista',
            'nome_do_album',
            'ano_de_lancamento',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                $musica->$campo = $request->$campo;
            }
        }

        $musica->save();
        return response()->json($musica, 200);
    }

    public function removerMusicaEspecifica($id)
    {
        $musica = ListaDeMusicas::find($id);

        if (!$musica) {
            return response()->noContent();
        }

        $musica->delete();
        return response()->json(['mensagem' => 'Música deletada com sucesso'], 200);
    }
}
