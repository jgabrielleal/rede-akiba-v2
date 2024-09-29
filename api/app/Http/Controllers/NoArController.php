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
        }
            
        return response()->noContent();
    }

    public function retornaRegistroEspecificoDoNoAr($id)
    {
        $noAr = NoAr::where('id', $id)->first();

        if ($noAr !== null) {
            $noAr->load('programa');

            return response()->json($noAr, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraRegistroDoNoAr(Request $request)
    {
        $request->validate([
            'programa' => 'required|exists:programas,id',
            'tipo_de_transmissao' => 'required|string',
            'data_da_transmissao' => 'required|string',
            'inicio_da_transmissao' => 'required|string',
            'fim_da_transmissao' => 'required|string',
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
            return response()->noContent();
        }
        $request->validate([
            'programa' => 'required|exists:programas,id',
            'tipo_de_transmissao' => 'required|string',
            'data_da_transmissao' => 'required|string',
            'inicio_da_transmissao' => 'required|string',
            'fim_da_transmissao' => 'required|string',
        ]);

        $update = [
            'programa' => $request->programa,
            'controle_de_pedidos' => $request->controle_de_pedidos,
            'tipo_de_transmissao' => $request->tipo_de_transmissao,
            'data_da_transmissao' => $request->data_da_transmissao,
            'inicio_da_transmissao' => $request->inicio_da_transmissao,
            'fim_da_transmissao' => $request->fim_da_transmissao,
        ];

        $NoAr->update($update);
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
