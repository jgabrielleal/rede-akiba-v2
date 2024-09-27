<?php

namespace App\Http\Controllers;;

use App\Models\Formularios;
use Illuminate\Http\Request;

class FormulariosController extends Controller
{
    public function retornaTodosFormularios()
    {
        $formularios = Formularios::with(['ultima_visualizacao'])->paginate(10);

        if ($formularios->isNotEmpty()) {
            return response()->json($formularios, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaFormularioEspecifico($id)
    {
        $formulario = Formularios::where('id', $id)->first();

        if ($formulario !== null) {
            $formulario->load('ultima_visualizacao');
            return response()->json($formulario, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraFormulario(Request $request)
    {
        $formulario = Formularios::create([
            'tipo_de_formulario' => $request->tipo_de_formulario,
            'dados_do_formulario' => $request->dados_do_formulario,
        ]);

        return response()->json($formulario, 200);
    }

    public function atualizaFormularioEspecifico(Request $request, $id)
    {
        $formulario = Formularios::where('id', $id)->first();

        if (!$formulario) {
            return response()->noContent();
        }

        $validacao = $request->validate([
            'ultima_visualizacao' => 'exists:usuarios,id',
        ]);

        $camposAtualizaveis = [
            'ultima_visualizacao',
            'tipo_de_formulario',
            'dados_do_formulario',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if (isset($request->$campo)) {
                $formulario->$campo = $request->$campo;
            }
        }

        $formulario->save();
        return response()->json($formulario, 200);
    }

    public function removerFormularioEspecifico($id)
    {
        $formulario = Formularios::find($id);

        if (!$formulario) {
            return response()->noContent();
        }

        $formulario->delete();
        return response()->json(['mensagem' => 'Formulário removido com sucesso'], 200);
    }
}
