<?php

namespace App\Http\Controllers\Api;

use App\Models\Eventos;
use App\Models\Usuarios;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class EventosController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosEventos()
    {
        try{
            $eventos = Eventos::with('autor')->paginate(10);

            if($eventos->isNotEmpty()){
                return response()->json($eventos, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum evento encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function retornaEventoEspecifico($slug)
    {
        try{
            $evento = Eventos::where('slug', $slug)->first();

            if($evento !== null){
                $evento->load('autor');
                return response()->json($evento, 200);
            }else{
                return response()->json(['mensagem' => 'Evento não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function cadastraEvento(Request $request)
    {
        try{
            $validacao = $request->validate([
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
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function atualizaEventoEspecifico(Request $request, $slug)
    {
        try{
            $evento = Eventos::where('slug', $slug)->first();

            if(!$evento){
                return response()->json(['mensagem' => 'Evento não encontrado'], 404);
            }

            $validacao = $request->validate([
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

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    switch($campo){
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
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }    
    }

    public function removerEventoEspecifico($id)
    {
        try{
            $evento = Eventos::find($id);

            if(!$evento){
                return response()->json(['mensagem' => 'Evento não encontrado'], 404);
            }

            $this->removeImage($evento, 'imagem_em_destaque');
            $this->removeImage($evento, 'capa_do_evento');

            $evento->delete();
            return response()->json(['mensagem' => 'Evento removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }
}
