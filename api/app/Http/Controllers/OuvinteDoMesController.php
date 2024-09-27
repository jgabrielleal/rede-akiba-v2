<?php

namespace App\Http\Controllers;;

use App\Models\OuvinteDoMes;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;
use Illuminate\Http\Request;

class OuvinteDoMesController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaOuvinteDoMesEspecifico()
    {
        $ouvinte = OuvinteDoMes::where('id', 1)->first();

        if ($ouvinte !== null) {
            $ouvinte->load('programa_favorito');
            return response()->json($ouvinte, 200);
        } else {
            return response()->noContent();
        }
    }

    public function atualizaOuvinteDoMesEspecifico(Request $request)
    {
        $ouvinte = OuvinteDoMes::where('id', 1)->first();

        if (!$ouvinte) {
            return response()->noContent();
        }

        $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif',
            'quantidade_de_pedidos' => 'required',
            'programa_favorito' => 'required|exists:programas,id',
        ]);

        $camposAtualizaveis = [
            'nome',
            'endereco',
            'avatar',
            'quantidade_de_pedidos',
            'programa_favorito',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                if ($campo === 'avatar') {
                    $this->removeImage($ouvinte, 'avatar');
                    $ouvinte->avatar = $this->uploadImage($request, 'avatar', 'ouvinte_do_mes');
                }
            }
        }

        $ouvinte->save();
        return response()->json($ouvinte, 200);
    }
}
