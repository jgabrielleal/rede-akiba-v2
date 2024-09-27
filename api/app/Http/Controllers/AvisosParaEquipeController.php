<?php

namespace App\Http\Controllers;;

use App\Models\AvisosParaEquipe;
use Illuminate\Http\Request;

class AvisosParaEquipeController extends Controller
{
    public function retornaTodosOsAvisosParaEquipe()
    {
        $avisos = AvisosParaEquipe::with(['remetente', 'destinatario'])->paginate(10);

        if ($avisos->isNotEmpty()) {
            return response()->json($avisos, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaAvisoParaEquipeEspecifico($id)
    {
        $aviso = AvisosParaEquipe::where('id', $id)->first();

        if ($aviso !== null) {
            $aviso->load('remetente', 'destinatario');
            return response()->json($aviso, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraAvisoParaEquipe(Request $request)
    {
        $validacao = $request->validate([
            'remetente' => 'required|exists:usuarios,id',
            'destinatario' => 'required|exists:usuarios,id',
            'mensagem' => 'required',
        ]);

        $aviso = AvisosParaEquipe::create([
            'remetente' => $request->remetente,
            'destinatario' => $request->destinatario,
            'mensagem' => $request->mensagem,
        ]);

        return response()->json($aviso, 200);
    }

    public function atualizaAvisoParaEquipeEspecifico(Request $request, $id)
    {
        $aviso = AvisosParaEquipe::where('id', $id)->first();

        if (!$aviso) {
            return response()->noContent();
        }

        $validacao = $request->validate([
            'remente' => 'exists:usuarios,id',
            'destinatario' => 'exists:usuarios,id',
        ]);

        $camposAtualizaveis = [
            'remente',
            'destinatario',
            'mensagem'
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                $aviso->$campo = $request->$campo;
            }
        }

        $aviso->save();
        return response()->json($aviso, 200);
    }

    public function removerAvisoParaEquipeEspecifico($id)
    {
        $aviso = AvisosParaEquipe::where('id', $id)->first();

        if (!$aviso) {
            return response()->noContent();
        }

        $aviso->delete();
        return response()->json(['mensagem' => 'Aviso removido com sucesso'], 200);
    }
}
