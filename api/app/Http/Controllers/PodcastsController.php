<?php

namespace App\Http\Controllers;;

use App\Models\Podcasts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PodcastsController extends Controller
{
    public function retornaTodosPodcasts()
    {
        $podcasts = Podcasts::with(['autor'])->paginate(10);

        if ($podcasts->isNotEmpty()) {
            return response()->json($podcasts, 200);
        }
            
        return response()->noContent();
    }

    public function retornaPodcastEspecifico($slug)
    {
        $podcast = Podcasts::where('slug', $slug)->first();

        if ($podcast !== null) {
            $podcast->load('autor');

            return response()->json($podcast, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraPodcast(Request $request)
    {
        $request->validate([
            'autor' => 'required|exists:usuarios,id',
            'temporada' => 'required|string',
            'episodio' => 'required|string',
            'titulo_do_episodio' => 'required|string',
            'capa_do_episodio' => 'required|string',
            'descricao_do_episodio' => 'required|string',
            'conteudo_da_publicacao' => 'required|string',
            'endereco_do_audio' => 'required|string',
            'agregadores' => 'required|string',
        ]);

        $podcast = Podcasts::create([
            'slug' => Str::slug($request->titulo),
            'autor' => $request->autor,
            'temporada' => $request->temporada,
            'episodio' => $request->episodio,
            'titulo' => $request->titulo,
            'capa_do_episodio' => $request->capa_do_episodio,
            'descricao_do_episodio' => $request->descricao_do_episodio,
            'conteudo_da_publicacao' => $request->conteudo_da_publicacao,
            'endereco_do_audio' => $request->endereco_do_audio,
            'aggregadores' => $request->aggregadores,
        ]);

        return response()->json($podcast, 200);
    }

    public function atualizaPodcastEspecifico(Request $request, $slug)
    {
        $podcast = Podcasts::where('slug', $slug)->first();

        if (!$podcast) {
            return response()->noContent();
        }

        $request->validate([
            'temporada' => 'required|string',
            'episodio' => 'required|string',
            'titulo_do_episodio' => 'required|string',
            'capa_do_episodio' => 'required|string',
            'descricao_do_episodio' => 'required|string',
            'conteudo_da_publicacao' => 'required|string',
            'endereco_do_audio' => 'required|string',
            'agregadores' => 'required|string',
        ]);

        $update = [
            'temporada' => $request->temporada,
            'episodio' => $request->episodio,
            'titulo' => $request->titulo,
            'capa_do_episodio' => $request->capa_do_episodio,
            'descricao_do_episodio' => $request->descricao_do_episodio,
            'conteudo_da_publicacao' => $request->conteudo_da_publicacao,
            'endereco_do_audio' => $request->endereco_do_audio,
            'aggregadores' => $request->aggregadores,
        ];

        $podcast->update($update);
        return response()->json($podcast, 200);
    }

    public function removerPodcastEspecifico($id)
    {
        $podcast = Podcasts::where('id', $id)->first();

        if (!$podcast) {
            return response()->noContent();
        }

        $podcast->delete();
        return response()->json(['mensagem' => 'Podcast deletado com sucesso'], 200);
    }
}
