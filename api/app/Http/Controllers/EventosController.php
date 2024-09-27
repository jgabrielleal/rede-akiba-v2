<?php

namespace App\Http\Controllers;;

use App\Models\Eventos;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventosController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosEventos()
    {
        $eventos = Eventos::with(['autor'])->paginate(10);

        if ($eventos->isNotEmpty()) {
            return response()->json($eventos, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaEventoEspecifico($slug)
    {
        $evento = Eventos::where('slug', $slug)->first();

        if ($evento !== null) {
            $evento->load('autor');
            return response()->json($evento, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraEvento(Request $request)
    {
        $request->validate([
            'autor' => 'required|exists:usuarios,id',
            'titulo' => 'required',
            'imagem_em_destaque' => 'required|image|mimes:jpeg,png,jpg,gif',
            'capa_do_evento' => 'required|image|mimes:jpeg,png,jpg,gif',
            'datas' => 'required',
            'local' => 'required',
            'conteudo' => 'required'
        ]);

        $evento = Eventos::create([
            'slug' => Str::slug($request->titulo),
            'autor' => $request->autor,
            'titulo' => $request->titulo,
            'imagem_em_destaque' => $this->uploadImage($request, 'imagem_em_destaque'),
            'capa_do_evento' => $this->uploadImage($request, 'capa_do_evento'),
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
            'autor' => 'exists:usuarios,id',
            'imagem_em_destaque' => 'image|mimes:jpeg,png,jpg,gif',
            'capa_do_evento' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $camposAtualizaveis = [
            'autor',
            'titulo',
            'datas',
            'local',
            'conteudo'
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                switch ($campo) {
                    case 'titulo':
                        $evento->slug = Str::slug($request->titulo);
                        $evento->titulo = $request->titulo;
                        break;
                    case 'imagem_em_destaque':
                        $this->removeImage($evento, 'imagem_em_destaque');
                        $evento->imagem_em_destaque = $this->uploadImage($request, 'imagem_em_destaque');
                        break;
                    case 'capa_do_evento':
                        $this->removeImage($evento, 'capa_do_evento');
                        $evento->capa_do_evento = $this->uploadImage($request, 'capa_do_evento');
                        break;
                    default:
                        $evento->$campo = $request->$campo;
                        break;
                }
            }
        }

        $evento->save();
        return response()->json($evento, 200);
    }

    public function removerEventoEspecifico($id)
    {
        $evento = Eventos::find($id);

        if (!$evento) {
            return response()->noContent();
        }

        $this->removeImage($evento, 'imagem_em_destaque');
        $this->removeImage($evento, 'capa_do_evento');

        $evento->delete();
        return response()->json(['mensagem' => 'Evento removido com sucesso'], 200);
    }
}
