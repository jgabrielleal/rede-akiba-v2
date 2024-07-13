<?php

namespace App\Http\Controllers\Api;

use App\Models\Calendario;
use App\Models\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalendarioController extends Controller
{
    public function retornaTodoCalendarioDeEventos()
    {
        try{
            $calendario = Calendario::with('designado')->paginate(10);

            if($calendario->isNotEmpty()){
                return response()->json($calendario, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum evento encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function retornaEventoDoCalendarioEspecifico($id)
    {
        try{
            $calendario = Calendario::where('id', $id)->first();

            if($calendario !== null){
                $calendario->load('designado');
                return response()->json($calendario, 200);
            }else{
                return response()->json(['mensagem' => 'Evento não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function cadastraEventoNoCalendario(Request $request)
    {
        try{
            $validacao = $request->validate([
                'data' => 'required',
                'hora' => 'required',
                'evento' => 'required',
                'designado' => 'required|exists:usuarios,id',
                'categoria' => 'required',
            ]);

            $evento = Calendario::create([
                'data' => $request->data,
                'hora' => $request->hora,
                'evento' => $request->evento,
                'designado' => $request->designado,
                'categoria' => $request->categoria,
            ]);

            return response()->json($evento, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function atualizaEventoDoCalendarioEspecifico(Request $request, $id)
    {
        try{
            $evento = Calendario::where('id', $id)->first();

            if(!$evento){
                return response()->json(['mensagem' => 'Evento não encontrado'], 404);
            }

            $validacao = $request->validate([
                'designado' => 'exists:usuarios,id',
            ]);

            $camposAtualizaveis = [
                'data',
                'hora',
                'evento',
                'designado',
                'categoria',
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    $evento->$campo = $request->$campo;
                }
            }

            $evento->save();
            return response()->json($evento, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function removerEventoDoCalendarioEspecifico($id)
    {
        try{
            $evento = Calendario::where('id', $id)->first();

            if(!$evento){
                return response()->json(['mensagem' => 'Evento não encontrado'], 404);
            }

            $evento->delete();
            return response()->json(['mensagem' => 'Evento removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }
}
