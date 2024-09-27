<?php

namespace App\Http\Controllers;;

use App\Models\BatalhaDePlaylist;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;

class BatalhaDePlaylistController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaBatalhaDePlaylistEspecifica()
    {
        $batalha = BatalhaDePlaylist::where('id', 1)->first();

        if ($batalha !== null) {
            $batalha->load('primeiro_competidor');
            $batalha->load('segundo_competidor');
            return response()->json($batalha, 200);
        } else {
            return response()->noContent();
        }
    }

    public function atualizaBatalhaDePlaylistEspecifica(Request $request)
    {
        $batalha = BatalhaDePlaylist::where('id', 1)->first();

        if (!$batalha) {
            return response()->noContent();
        }

        $request->validate([
            'imagem' => 'image|mimes:jpeg,png,jpg,gif',
            'primeiro_competidor' => 'required|exists:usuarios,id',
            'segundo_competidor' => 'required|exists:usuarios,id'
        ]);

        $camposAtualizaveis = [
            'imagem',
            'primeiro_competidor',
            'segundo_competidor',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if (isset($campo)) {
                if ($campo == 'imagem') {
                    $this->removeImage($batalha, 'imagem');
                    $batalha->$campo = $this->uploadImage($request, 'imagem');
                } else {
                    $batalha->$campo = $request->$campo;
                }
            }
        }

        $batalha->save();
        return response()->json($batalha, 200);
    }
}
