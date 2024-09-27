<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriasController extends Controller
{
    use UploadImage, RemoveImage;

    public function retornaTodasMaterias()
    {
        $materias = Materias::with(['autor'])->paginate(10);

        if ($materias->isNotEmpty()) {
            return response()->json($materias, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaMateriaEspecifica($slug)
    {
        $materia = Materias::where('slug', $slug)->first();

        if ($materia !== null) {
            $materia->load('autor');
            return response()->json($materia, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraMateria(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'autor' => 'required|exists:usuarios,id',
            'imagem_em_destaque' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'capa_da_materia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titulo' => 'required|string|unique:materias,titulo',
            'conteudo' => 'required|string',
            'tags' => 'required|array',
            'fontes_de_pesquisa' => 'required|array',
        ]);

        $materia = Materias::create([
            'slug' => Str::slug($request->titulo),
            'status' => $request->status,
            'autor' => $request->autor,
            'imagem_em_destaque' => $this->uploadImage($request, 'imagem_em_destaque'),
            'capa_da_materia' => $this->uploadImage($request, 'capa_da_materia'),
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

        $request->validate([
            'autor' => 'exists:usuarios,id',
            'imagem_em_destaque' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'capa_da_materia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titulo' => 'string|unique:materias,titulo,' . $materia->id,
            'conteudo' => 'string',
            'tags' => 'array',
            'fontes_de_pesquisa' => 'array',
        ]);

        $camposAtualizaveis = [
            'slug',
            'status',
            'autor',
            'imagem_em_destaque',
            'capa_da_materia',
            'titulo',
            'conteudo',
            'tags',
            'fontes_de_pesquisa',
            'reacoes',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                switch ($campo) {
                    case 'imagem_em_destaque':
                        $this->removeImage($materia, 'imagem_em_destaque');
                        $materia->imagem_em_destaque = $this->uploadImage($request, 'imagem_em_destaque');
                        break;
                    case 'capa_da_materia':
                        $this->removeImage($materia, 'capa_da_materia');
                        $materia->capa_da_materia = $this->uploadImage($request, 'capa_da_materia');
                        break;
                    default:
                        $materia->$campo = $request->$campo;
                        break;
                }
            }
        }

        $materia->save();
        return response()->json($materia, 200);
    }

    public function removerMateriaEspecifica($id)
    {
        $materia = Materias::find($id);

        if (!$materia) {
            return response()->noContent();
        }

        $this->removeImage($materia, 'imagem_em_destaque');
        $this->removeImage($materia, 'capa_da_materia');

        $materia->delete();
        return response()->json(['mensagem' => 'Matéria removida com sucesso'], 200);
    }
}