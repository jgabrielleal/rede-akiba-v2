<?php

namespace App\Http\Controllers;;

use App\Models\ListaDeMusicas;
use Illuminate\Http\Request;

class ListaDeMusicasController extends Controller
{
    public function retornaTodasMusicas()
    {
        $musicas = ListaDeMusicas::paginate(10);

        if ($musicas->isNotEmpty()) {
            return response()->json($musicas, 200);
        }
            
        return response()->noContent();
    }

    public function retornaMusicaEspecifica($id)
    {
        $musica = ListaDeMusicas::where('id', $id)->first();

        if ($musica) {
            return response()->json($musica, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraMusica(Request $request)
    {
        $request->validate([
            'nome_do_anime' => 'required|string',
            'nome_da_musica' => 'required|string',
            'nome_do_artista' => 'required|string',
            'nome_do_album' => 'required|string',
            'ano_de_lancamento' => 'required|string',
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

        $request->validate([
            'nome_do_anime' => 'required|string',
            'nome_da_musica' => 'required|string',
            'nome_do_artista' => 'required|string',
            'nome_do_album' => 'required|string',
            'ano_de_lancamento' => 'required|string',
        ]);

        $update = [
            'numero_de_vezes_tocada' => $request->numero_de_vezes_tocada,
            'nome_do_anime' => $request->nome_do_anime,
            'nome_da_musica' => $request->nome_da_musica,
            'nome_do_artista' => $request->nome_do_artista,
            'nome_do_album' => $request->nome_do_album,
            'ano_de_lancamento' => $request->ano_de_lancamento,
        ];

        $musica->update($update);
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
