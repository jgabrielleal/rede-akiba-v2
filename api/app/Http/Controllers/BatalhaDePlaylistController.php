<?php

namespace App\Http\Controllers;;

use App\Models\BatalhaDePlaylist;
use Illuminate\Http\Request;

class BatalhaDePlaylistController extends Controller
{
    public function retornaBatalhaDePlaylistEspecifica()
    {
        $batalha = BatalhaDePlaylist::where('id', 1)->first();

        if ($batalha !== null) {
            $batalha->load('primeiro_competidor');
            $batalha->load('segundo_competidor');

            return response()->json($batalha, 200);
        } 

        return response()->noContent();
    }

    public function atualizaBatalhaDePlaylistEspecifica(Request $request)
    {
        $batalha = BatalhaDePlaylist::where('id', 1)->first();

        if (!$batalha) {
            return response()->noContent();
        }

        $request->validate([
            'imagem' => 'required|string',
            'primeiro_competidor' => 'required|exists:usuarios,id',
            'segundo_competidor' => 'required|exists:usuarios,id'
        ]);

        $update = [
            'imagem' => $request->imagem,
            'primeiro_competidor' => $request->primeiro_competidor,
            'segundo_competidor' => $request->segundo_competidor,
        ];

        $batalha->update($update);
        return response()->json($batalha, 200);
    }
}
