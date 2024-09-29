<?php

namespace App\Http\Controllers;;

use App\Models\Tarefas;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    public function retornaTodasTarefas()
    {
        $tarefas = Tarefas::with(['administrador', 'executante'])->paginate(10);

        if ($tarefas->isNotEmpty()) {
            return response()->json($tarefas, 200);
        }
           
        return response()->noContent();
    }

    public function retornaTarefaEspecifica($id)
    {
        $tarefa = Tarefas::where('id', $id)->first();

        if ($tarefa !== null) {
            $tarefa->load('administrador', 'executante');

            return response()->json($tarefa, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraTarefa(Request $request)
    {
        $request->validate([
            'administrador' => 'required|exists:usuarios,id',
            'executante' => 'required|exists:usuarios,id',
            'tarefa_a_ser_executada' => 'required|string',
            'tarefa_concluida' => 'required|string',
        ]);

        $tarefa = Tarefas::create([
            'administrador' => $request->administrador,
            'executante' => $request->executante,
            'tarefa_a_ser_executada' => $request->tarefa_a_ser_executada,
            'tarefa_concluida' => $request->tarefa_concluida,
        ]);

        return response()->json($tarefa, 200);
    }

    public function atualizaTarefaEspecifica(Request $request, $id)
    {
        $tarefa = Tarefas::where('id', $id)->first();

        if (!$tarefa) {
            return response()->noContent();
        }

        $request->validate([
            'executante' => 'required|exists:usuarios,id',
            'tarefa_a_ser_executada' => 'required|string',
            'tarefa_concluida' => 'required|string',
        ]);

        $update = [
            'executante' => $request->executante,
            'tarefa_a_ser_executada' => $request->tarefa_a_ser_executada,
            'tarefa_concluida' => $request->tarefa_concluida,
        ];

        $tarefa->update($update);
        return response()->json($tarefa, 200);
    }

    public function removerTarefaEspecifica($id)
    {
        $tarefa = Tarefas::where('id', $id)->first();

        if (!$tarefa) {
            return response()->noContent();
        }

        $tarefa->delete();
        return response()->json(['mensagem' => 'Tarefa removida com sucesso'], 200);
    }
}
