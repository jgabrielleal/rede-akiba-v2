<?php

namespace App\Http\Controllers;

use App\Models\Tarefas;
use App\Models\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TarefasController extends Controller
{
    public function retornaTodasTarefas()
    {
        try{
            $tarefas = Tarefas::with(['administrador', 'executante'])->paginate(10);

            if($tarefas->isNotEmpty()){
                return response()->json($tarefas, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhuma tarefa encontrada'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaTarefaEspecifica($id)
    {
        try{
            $tarefa = Tarefas::where('id', $id)->first();

            if($tarefa !== null){
                $tarefa->load('administrador', 'executante');
                return response()->json($tarefa, 200);
            }else{
                return response()->json(['mensagem' => 'Tarefa não encontrada'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraTarefa(Request $request)
    {
        try{
            $validacao = $request->validate([
                'administrador' => 'required|exists:usuarios,id',
                'executante' => 'required|exists:usuarios,id',
                'tarefa_a_ser_executada' => 'required',
                'tarefa_concluida' => 'required',
            ]);

            $tarefa = Tarefas::create([
                'administrador' => $request->administrador,
                'executante' => $request->executante,
                'tarefa_a_ser_executada' => $request->tarefa_a_ser_executada,
                'tarefa_concluida' => $request->tarefa_concluida,
            ]);

            return response()->json($tarefa, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function atualizaTarefaEspecifica(Request $request, $id)
    {
        try{
            $tarefa = Tarefas::where('id', $id)->first();

            if(!$tarefa){
                return response()->json(['mensagem' => 'Tarefa não encontrada'], 404);
            }

            $validacao = $request->validate([
                'administrador' => 'exists:usuarios,id',
                'executante' => 'exists:usuarios,id',
            ]);

            $camposAtualizaveis = [
                'administrador',
                'executante',
                'tarefa_a_ser_executada',
                'tarefa_concluida'
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    $tarefa->$campo = $request->$campo;
                }
            }

            $tarefa->save();
            return response()->json($tarefa, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerTarefaEspecifica($id)
    {
        try{
            $tarefa = Tarefas::where('id', $id)->first();

            if(!$tarefa){
                return response()->json(['mensagem' => 'Tarefa não encontrada'], 404);
            }

            $tarefa->delete();
            return response()->json(['mensagem' => 'Tarefa removida com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
