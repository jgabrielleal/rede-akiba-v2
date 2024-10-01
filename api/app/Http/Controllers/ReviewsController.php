<?php

namespace App\Http\Controllers;;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReviewsController extends Controller
{
    public function retornaTodosReviews()
    {
        $reviews = Reviews::with(['autor'])->paginate(10);

        if ($reviews->isNotEmpty()) {
            return response()->json($reviews, 200);
        }
            
        return response()->noContent();
    }

    public function retornaReviewEspecifico($slug)
    {
        $review = Reviews::where('slug', $slug)->first();

        if ($review !== null) {
            $review->load('autor');

            return response()->json($review, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraReview(Request $request)
    {
        $request->validate([
            'autor' => 'required|exists:usuarios,id',
            'imagem_em_destaque' => 'required|string',
            'capa_da_review' => 'required|string',
            'titulo' => 'required|string',
            'sinopse' => 'required|string',
            'conteudo' => 'required',
        ]);

        $review = Reviews::create([
            'slug' => Str::slug($request->titulo),
            'autor' => $request->autor,
            'imagem_em_destaque' => $request->imagem_em_destaque,
            'capa_da_review' => $request->capa_da_review,
            'titulo' => $request->titulo,
            'sinopse' => $request->sinopse,
            'conteudo' => $request->conteudo,
            'reacoes' => $request->reacoes,
        ]);

        return response()->json($review, 200);
    }

    public function atualizaReviewEspecifico(Request $request, $slug)
    {
        $review = Reviews::where('slug', $slug)->first();

        if (!$review) {
            return response()->noContent();
        }

        $request->validate([
            'imagem_em_destaque' => 'required|string',
            'capa_da_review' => 'required|string',
            'titulo' => 'required|string',
            'sinopse' => 'required|string',
            'conteudo' => 'required|string',
            'reacoes' => 'required|string',
        ]);

        $update = [
            'imagem_em_destaque' => $request->imagem_em_destaque,
            'capa_do_review' => $request->capa_do_review,
            'titulo' => $request->titulo,
            'sinopse' => $request->sinopse,
            'conteudo' => $request->conteudo,
            'reacoes' => $request->reacoes,
        ];

        $review->update($update);
        return response()->json($review, 200);
    }

    public function removerReviewEspecifico($id)
    {
        $review = Reviews::find($id);

        if (!$review) {
            return response()->noContent();
        }

        $review->delete();
        return response()->json(['mensagem' => 'Review removido com sucesso'], 200);
    }
}
