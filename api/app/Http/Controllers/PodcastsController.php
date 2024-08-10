<?php

namespace App\Http\Controllers;;

use App\Models\Podcasts;
use App\Models\Usuarios;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PodcastsController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosPodcasts()
    {
        try{
            $podcasts = Podcasts::with(['autor'])->paginate(10);

            if($podcasts->isNotEmpty()){
                return response()->json($podcasts, 200);
            }else{
                return response()->noContent();
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaPodcastEspecifico($slug)
    {
        try{
            $podcast = Podcasts::where('slug', $slug)->first();

            if($podcast !== null){
                $podcast->load('autor');
                return response()->json($podcast, 200);
            }else{
                return response()->noContent();
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraPodcast(Request $request)
    {
        try{
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
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function atualizaPodcastEspecifico(Request $request, $slug)
    {
        try{
            $podcast = Podcasts::where('slug', $slug)->first();

            if(!$podcast){
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

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    switch($campo){
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
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerPodcastEspecifico($id)
    {
        try{
            $podcast = Podcasts::where('id', $id)->first();

            if(!$podcast){
                return response()->noContent();
            }

            $this->removeImage($podcast, 'capa_do_episodio');

            $podcast->delete();
            return response()->json(['mensagem' => 'Podcast deletado com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
