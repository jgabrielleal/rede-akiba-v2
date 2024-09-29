<?php

namespace App\Http\Controllers;;

use App\Models\Calendario;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function retornaTodoCalendarioDeEventos()
    {
        $calendario = Calendario::with(['designado'])->paginate(10);

        if ($calendario->isNotEmpty()) {
            return response()->json($calendario, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaEventoDoCalendarioEspecifico($id)
    {
        $calendario = Calendario::where('id', $id)->first();

        if ($calendario !== null) {
            $calendario->load('designado');

            return response()->json($calendario, 200);
        }
        
        return response()->noContent();
    }

    public function cadastraEventoNoCalendario(Request $request)
    {
        $request->validate([
            'dia' => 'required|string',
            'hora' => 'required|string',
            'evento' => 'required|string',
            'designado' => 'required|exists:usuarios,id',
            'categoria' => 'required|string',
        ]);

        $evento = Calendario::create([
            'dia' => $request->dia,
            'hora' => $request->hora,
            'evento' => $request->evento,
            'designado' => $request->designado,
            'categoria' => $request->categoria,
        ]);

        return response()->json($evento, 200);
    }

    public function atualizaEventoDoCalendarioEspecifico(Request $request, $id)
    {
        $evento = Calendario::where('id', $id)->first();

        if (!$evento) {
            return response()->noContent();
        }

        $request->validate([
            'dia' => 'required|string',
            'hora' => 'required|string',
            'evento' => 'required|string',
            'designado' => 'required|exists:usuarios,id',
            'categoria' => 'required|string',
        ]);

        $update = [
            'dia' => $request->dia,
            'hora' => $request->hora,
            'evento' => $request->evento,
            'designado' => $request->designado,
            'categoria' => $request->categoria,
        ];
        
        $evento->update($update);
        return response()->json($evento, 200);
    }

    public function removerEventoDoCalendarioEspecifico($id)
    {
        $evento = Calendario::where('id', $id)->first();

        if (!$evento) {
            return response()->noContent();
        }

        $evento->delete();
        return response()->json(['mensagem' => 'Evento removido com sucesso'], 200);
    }
}
