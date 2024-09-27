<?php

namespace App\Http\Controllers;;

use App\Models\NoAr;
use Illuminate\Http\Request;

class NoArController extends Controller
{
    public function retornaTodosOsRegistrosDoNoAr()
    {
        $noAr = NoAr::with(['programa'])->paginate(10);

        if ($noAr->isNotEmpty()) {
            return response()->json($noAr, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaRegistroEspecificoDoNoAr($id)
    {
        $noAr = NoAr::where('id', $id)->first();

        if ($noAr !== null) {
            $noAr->load('programa');
            return response()->json($noAr, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraRegistroDoNoAr(Request $request)
    {
        $request->validate([
            'programa' => 'required|exists:programas,id',
            'tipo_de_transmissao' => 'required',
            'data_da_transmissao' => 'required',
            'inicio_da_transmissao' => 'required',
            'fim_da_transmissao' => 'required',
        ]);

        $noAr = NoAr::create([
            'programa' => $request->programa,
            'controle_de_pedidos' => 0,
            'tipo_de_transmissao' => $request->tipo_de_transmissao,
            'data_da_transmissao' => $request->data_da_transmissao,
            'inicio_da_transmissao' => $request->inicio_da_transmissao,
            'fim_da_transmissao' => $request->fim_da_transmissao,
        ]);

        return response()->json($noAr, 200);
    }

    public function atualizaRegistroEspecificoDoNoAr(Request $request, $id)
    {
        $NoAr = NoAr::where('id', $id)->first();

        if (!$NoAr) {
            return response()->json(['mensagem' => 'Registro no histórico de programação não encontrado'], 204);
        }

        $request->validate([
            'programa' => 'exists:programas,id',
        ]);

        $camposAtualizaveis = [
            'programa',
            'controle_de_pedidos',
            'tipo_de_transmissao',
            'data_da_transmissao',
            'inicio_da_transmissao',
            'fim_da_transmissao',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                $NoAr->$campo = $request->$campo;
            }
        }

        $NoAr->save();
        return response()->json($NoAr, 200);
    }

    public function removerRegistroEspecificoDoNoAr($id)
    {
        $noAr = NoAr::find($id);

        if (!$noAr) {
            return response()->noContent();
        }

        $noAr->delete();
        return response()->json(['mensagem' => 'Registro no histórico de programação removido com sucesso'], 200);
    }
}
