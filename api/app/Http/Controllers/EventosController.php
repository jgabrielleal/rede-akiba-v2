<?php

namespace App\Http\Controllers;;

use App\Models\Eventos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventosController extends Controller
{
    public function retornaTodosEventos()
    {
        $eventos = Eventos::with(['autor'])->orderBy('id', 'desc')->paginate(10);

        if ($eventos->isNotEmpty()) {
            return response()->json($eventos, 200);
        }
            
        return response()->noContent();
    }

    public function retornaEventoEspecifico($slug)
    {
        $evento = Eventos::where('slug', $slug)->first();

        if ($evento) {
            $evento->load('autor');
            
            return response()->json($evento, 200);
        }

        return response()->noContent();
    }

    public function cadastraEvento(Request $request)
    {
        $request->validate([
            'autor' => 'required|exists:usuarios,id',
            'titulo' => 'required|string',
            'imagem_em_destaque' => 'required|string',
            'capa_do_evento' => 'required|string',
            'datas' => 'required|string',
            'local' => 'required|string',
            'conteudo' => 'required|string'
        ]);

        $evento = Eventos::create([
            'slug' => Str::slug($request->titulo),
            'autor' => $request->autor,
            'titulo' => $request->titulo,
            'imagem_em_destaque' => $request->imagem_em_destaque,
            'capa_do_evento' => $request->capa_do_evento,
            'datas' => $request->datas,
            'local' => $request->local,
            'conteudo' => $request->conteudo
        ]);

        return response()->json($evento, 200);
    }

    public function atualizaEventoEspecifico(Request $request, $slug)
    {
        $evento = Eventos::where('slug', $slug)->first();

        if (!$evento) {
            return response()->noContent();
        }

        $request->validate([
            'titulo' => 'required|string',
            'imagem_em_destaque' => 'required|string',
            'capa_do_evento' => 'required|string',
            'datas' => 'required|string',
            'local' => 'required|string',
            'conteudo' => 'required|string'
        ]);

        $update = [
            'slug' => Str::slug($request->titulo),
            'titulo' => $request->titulo,
            'imagem_em_destaque' => $request->imagem_em_destaque,
            'capa_do_evento' => $request->capa_do_evento,
            'datas' => $request->datas,
            'local' => $request->local,
            'conteudo' => $request->conteudo
        ];

        $evento->update($update);
        return response()->json($evento, 200);
    }

    public function removerEventoEspecifico($id)
    {
        $evento = Eventos::find($id);

        if (!$evento) {
            return response()->noContent();
        }

        $evento->delete();
        return response()->json(['mensagem' => 'Evento removido com sucesso'], 200);
    }
}
