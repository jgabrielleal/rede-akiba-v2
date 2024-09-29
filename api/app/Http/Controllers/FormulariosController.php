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

        if ($formulario) {
            $formulario->load('ultima_visualizacao');

            return response()->json($formulario, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraFormulario(Request $request)
    {
        $request->validate([
            'tipo_de_formulario' => 'required',
            'dados_do_formulario' => 'required',
        ]);

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

        $request->validate([
            'ultima_visualizacao' => 'exists:usuarios,id',
            'tipo_de_formulario' => 'required',
            'dados_do_formulario' => 'required',
        ]);

        $update = [
            'ultima_visualizacao' => $request->ultima_visualizacao,
            'tipo_de_formulario' => $request->tipo_de_formulario,
            'dados_do_formulario' => $request->dados_do_formulario,
        ];
    
        $formulario->update($update);
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
