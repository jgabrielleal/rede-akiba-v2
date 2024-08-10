<?php

namespace App\Http\Controllers;;

use App\Models\Reviews;
use App\Models\Usuarios;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ReviewsController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosReviews()
    {
        try{
            $reviews = Reviews::with(['autor'])->paginate(10);

            if($reviews->isNotEmpty()){
                return response()->json($reviews, 200);
            }else{
                return response()->noContent();
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaReviewEspecifico($slug)
    {
        try{
            $review = Reviews::where('slug', $slug)->first();

            if($review !== null){
                $review->load('autor');
                return response()->json($review, 200);
            }else{
                return response()->noContent();
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraReview(Request $request)
    {
        try{
            $validacao = $request->validate([
                'autor' => 'required|exists:usuarios,id',
                'imagem_em_destaque' => 'required|image|mimes:jpeg,png,jpg,gif',
                'capa_da_review' => 'required|image|mimes:jpeg,png,jpg,gif',
                'titulo' => 'required',
                'sinopse' => 'required',
                'conteudo' => 'required',
                'reacoes' => 'required',
            ]);

            $review = Reviews::create([
                'slug' => Str::slug($request->titulo),
                'autor' => $request->autor,
                'imagem_em_destaque' =>$this->uploadImage($request, 'imagem_em_destaque'),
                'capa_da_review' => $this->uploadImage($request, 'capa_da_review'),
                'titulo' => $request->titulo,
                'sinopse' => $request->sinopse,
                'conteudo' => $request->conteudo,
                'reacoes' => $request->reacoes,
            ]);

            return response()->json($review, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function atualizaReviewEspecifico(Request $request, $slug)
    {
        try{
            $review = Reviews::where('slug', $slug)->first();

            if(!$review){
                return response()->noContent();
            }

            $validacao = $request->validate([
                'autor' => 'exists:usuarios,id',
                'imagem_em_destaque' => 'image|mimes:jpeg,png,jpg,gif',
                'capa_do_review' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            $camposAtualizaveis = [
                'autor',
                'imagem_em_destaque',
                'capa_do_review',
                'titulo',
                'sinopse',
                'conteudo',
                'reacoes',
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    switch($campo){
                        case 'titulo':
                            $review->slug = Str::slug($request->titulo);
                            $review->titulo = $request->titulo;
                        break;
                        case 'imagem_em_destaque':
                            $this->removeImage($review, 'imagem_em_destaque');
                            $review->imagem_em_destaque = $this->uploadImage($request, 'imagem_em_destaque');
                        break;
                        case 'capa_do_review':
                            $this->removeImage($review, 'capa_do_review');
                            $review->capa_do_review = $this->uploadImage($request, 'capa_do_review');
                        break;
                        default:
                            $review->$campo = $request->$campo;
                        break;
                    }
                }
            }

            $review->save();
            return response()->json($review, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerReviewEspecifico($id)
    {
        try{
            $review = Reviews::find($id);

            if(!$review){
                return response()->noContent();
            }

            $this->removeImage($review, 'imagem_em_destaque');
            $this->removeImage($review, 'capa_do_review');

            $review->delete();
            return response()->json(['mensagem' => 'Review removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
