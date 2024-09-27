<?php

namespace App\Http\Controllers;;

use App\Models\Podcasts;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PodcastsController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosPodcasts()
    {
        $podcasts = Podcasts::with(['autor'])->paginate(10);

        if ($podcasts->isNotEmpty()) {
            return response()->json($podcasts, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaPodcastEspecifico($slug)
    {
        $podcast = Podcasts::where('slug', $slug)->first();

        if ($podcast !== null) {
            $podcast->load('autor');
            return response()->json($podcast, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraPodcast(Request $request)
    {
        $validacao = $request->validate([
            'autor' => 'required|exists:usuarios,id',
            'temporada' => 'required',
            'episodio' => 'required',
            'titulo_do_episodio' => 'required',
            'capa_do_episodio' => 'required',
            'descricao_do_episodio' => 'required',
            'conteudo_da_publicacao' => 'required',
            'endereco_do_audio' => 'required',
            'agregadores' => 'required',
        ]);

        $podcast = Podcasts::create([
            'slug' => Str::slug($request->titulo),
            'autor' => $request->autor,
            'temporada' => $request->temporada,
            'episodio' => $request->episodio,
            'titulo' => $request->titulo,
            'capa_do_episodio' => $this->uploadImage($request, 'capa_do_episodio'),
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

        $validacao = $request->validate([
            'autor' => 'exists:usuarios,id',
            'capa_do_episodio' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $camposAtualizaveis = [
            'slug',
            'autor',
            'temporada',
            'episodio',
            'titulo',
            'capa_do_episodio',
            'descricao_do_episodio',
            'conteudo_da_publicacao',
            'endereco_do_audio',
            'aggregadores',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                switch ($campo) {
                    case 'titulo':
                        $podcast->slug = Str::slug($request->titulo);
                        $podcast->titulo = $request->titulo;
                        break;
                    case 'capa_do_episodio':
                        $this->RemoveImage($podcast, 'capa_do_episodio');
                        $podcast->capa_do_episodio = $this->uploadImagem($request, 'capa_do_episodio');
                        break;
                    default:
                        $podcast->$campo = $request->$campo;
                        break;
                }
            }
        }

        $podcast->save();
        return response()->json($podcast, 200);
    }

    public function removerPodcastEspecifico($id)
    {
        $podcast = Podcasts::where('id', $id)->first();

        if (!$podcast) {
            return response()->noContent();
        }

        $this->removeImage($podcast, 'capa_do_episodio');

        $podcast->delete();
        return response()->json(['mensagem' => 'Podcast deletado com sucesso'], 200);
    }
}
