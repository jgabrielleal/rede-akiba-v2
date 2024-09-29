<?php

namespace App\Http\Controllers;;

use App\Models\OuvinteDoMes;
use Illuminate\Http\Request;

class OuvinteDoMesController extends Controller
{
    public function retornaOuvinteDoMesEspecifico()
    {
        $ouvinte = OuvinteDoMes::where('id', 1)->first();

        if ($ouvinte !== null) {
            $ouvinte->load('programa_favorito');

            return response()->json($ouvinte, 200);
        }
            
        return response()->noContent();
    }

    public function atualizaOuvinteDoMesEspecifico(Request $request)
    {
        $ouvinte = OuvinteDoMes::where('id', 1)->first();

        if (!$ouvinte) {
            return response()->noContent();
        }

        $request->validate([
            'nome' => 'required|string',
            'endereco' => 'required|string',
            'avatar' => 'required|string',
            'quantidade_de_pedidos' => 'required|string',
            'programa_favorito' => 'required|exists:programas,id',
        ]);

        $update = [
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'avatar' => $request->avatar,
            'quantidade_de_pedidos' => $request->quantidade_de_pedidos,
            'programa_favorito' => $request->programa_favorito,
        ];
        
        $ouvinte->update($update);
        return response()->json($ouvinte, 200);
    }
}
