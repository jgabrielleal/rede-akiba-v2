<?php

namespace App\Http\Controllers;

use App\Models\Formularios;
use App\Models\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormulariosController extends Controller
{
    public function retornaTodosFormularios()
    {
        try{
            $formularios = Formularios::with(['ultima_visualizacao'])->paginate(10);

            if($formularios->isNotEmpty()){
                return response()->json($formularios, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum formulário encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaFormularioEspecifico($id)
    {
        try{
            $formulario = Formularios::where('id', $id)->first();

            if($formulario !== null){
                $formulario->load('ultima_visualizacao');
                return response()->json($formulario, 200);
            }else{
                return response()->json(['mensagem' => 'Formulário não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraFormulario(Request $request)
    {
        try{
            $formulario = Formularios::create([
                'tipo_de_formulario' => $request->tipo_de_formulario,
                'dados_do_formulario' => $request->dados_do_formulario,
            ]);

            return response()->json($formulario, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function atualizaFormularioEspecifico(Request $request, $id)
    {
        try{
            $formulario = Formularios::where('id', $id)->first();

            if(!$formulario){
                return response()->json(['mensagem' => 'Formulário não encontrado'], 404);
            }

            $validacao = $request->validate([
                'ultima_visualizacao' => 'exists:usuarios,id',
            ]);

            $camposAtualizaveis = [
                'ultima_visualizacao',
                'tipo_de_formulario',
                'dados_do_formulario',
            ];

            foreach($camposAtualizaveis as $campo){
                if(isset($request->$campo)){
                    $formulario->$campo = $request->$campo;
                }
            }

            $formulario->save();
            return response()->json($formulario, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerFormularioEspecifico($id)
    {
        try{
            $formulario = Formularios::find($id);

            if(!$formulario){
                return response()->json(['mensagem' => 'Formulário não encontrado'], 404);
            }

            $formulario->delete();

            return response()->json(['mensagem' => 'Formulário removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
