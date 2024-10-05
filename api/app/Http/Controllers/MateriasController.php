<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriasController extends Controller
{
    public function retornaTodasMaterias()
    {
        $materias = Materias::with(['autor'])->orderBy('id', 'desc')->paginate(10);

        if ($materias->isNotEmpty()) {
            return response()->json($materias, 200);
        }
            
        return response()->noContent();
    }

    public function retornaMateriaEspecifica($slug)
    {
        $materia = Materias::where('slug', $slug)->first();

        if ($materia !== null) {
            $materia->load('autor');

            return response()->json($materia, 200);
        }

        return response()->noContent();
    }

    public function cadastraMateria(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'autor' => 'required|exists:usuarios,id',
            'titulo' => 'required|string|unique:materias,titulo',
            'conteudo' => 'required|string',
            'tags' => 'required|array',
            'fontes_de_pesquisa' => 'required|array',
            'imagem_em_destaque' => 'required|string',
            'capa_da_materia' => 'required|string',
        ]);

        $materia = Materias::create([
            'slug' => Str::slug($request->titulo),
            'status' => $request->status,
            'autor' => $request->autor,
            'imagem_em_destaque' => $request->imagem_em_destaque,
            'capa_da_materia' => $request->capa_da_materia,
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'tags' => $request->tags,
            'fontes_de_pesquisa' => $request->fontes_de_pesquisa,
        ]);

        return response()->json($materia, 200);
    }

    public function atualizaMateriaEspecifica(Request $request, $slug)
    {
        $materia = Materias::where('slug', $slug)->first();

        if (!$materia) {
            return response()->noContent();
        }

        $update = [
            'slug' => Str::slug($request->titulo),
            'status' => $request->status,
            'imagem_em_destaque' => $request->imagem_em_destaque,
            'capa_da_materia' => $request->capa_da_materia,
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'tags' => $request->tags,
            'fontes_de_pesquisa' => $request->fontes_de_pesquisa,
            'reacoes' => $request->reacoes,
        ];

        $materia->update($update);
        return response()->json($materia, 200);
    }

    public function removerMateriaEspecifica($id)
    {
        $materia = Materias::find($id);

        if (!$materia) {
            return response()->noContent();
        }

        $materia->delete();
        return response()->json(['mensagem' => 'Matéria removida com sucesso'], 200);
    }
}
