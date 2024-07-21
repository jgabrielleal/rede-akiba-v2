<?php

namespace App\Http\Controllers;;

use App\Models\Materias;
use App\Models\Usuarios;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MateriasController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodasMaterias()
    {
        try{
            $materias = Materias::with(['autor'])->paginate(10);

            if($materias->isNotEmpty()){
                return response()->json($materias, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhuma matéria encontrada'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaMateriaEspecifica($slug)
    {
        try{
            $materia = Materias::where('slug', $slug)->first();

            if($materia !== null){
                $materia->load('autor');
                return response()->json($materia, 200);
            }else{
                return response()->json(['mensagem' => 'Matéria não encontrada'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraMateria(Request $request)
    {
        try{
            $validacao = $request->validate([
                'publicado' => 'required|boolean',
                'autor' => 'required|exists:usuarios,id',
                'imagem_em_destaque' => 'required|image|mimes:jpeg,png,jpg,gif',
                'capa_da_materia' => 'required|image|mimes:jpeg,png,jpg,gif',
                'titulo' => 'required',
                'conteudo' => 'required',
                'tags' => 'required',
                'fontes_de_pesquisa' => 'required',
                'reacoes' => 'required',
            ]);

            $materia = Materias::create([
                'slug' => Str::slug($request->titulo),
                'publicado' => $request->publicado,
                'autor' => $request->autor,
                'imagem_em_destaque' => $this->uploadImage($request, 'imagem_em_destaque'),
                'capa_da_materia' => $this->uploadImage($request, 'capa_da_materia'),
                'titulo' => $request->titulo,
                'conteudo' => $request->conteudo,
                'tags' => $request->tags,
                'fontes_de_pesquisa' => $request->fontes_de_pesquisa,
                'reacoes' => $request->reacoes,
            ]);

            return response()->json($materia, 200);
        } catch (ValidationException $erro) {
            // Retorna uma resposta JSON com os detalhes dos erros de validação
            return response()->json(['mensagem' => 'Erro de validação', 'erros' => $erro->getMessage()], 422);
        } catch (\Exception $erro) {
            return response()->json(['mensagem' => 'Erro interno do servidor', 'erro' => $erro->getMessage()], 500);
        }
    }

    public function atualizaMateriaEspecifica(Request $request, $slug)
    {
        try{
            $materia = Materias::where('slug', $slug)->first();

            if(!$materia){
                return response()->json(['mensagem' => 'Matéria não encontrada'], 404);
            }

            $validacao = $request->validate([
                'autor' => 'exists:usuarios,id',
                'imagem_em_destaque' => 'image|mimes:jpeg,png,jpg,gif',
                'capa_da_materia' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            $camposAtualizaveis = [
                'slug',
                'publicada',
                'autor',
                'imagem_em_destaque',
                'capa_da_materia',
                'titulo',
                'conteudo',
                'tags',
                'fontes_de_pesquisa',
                'reacoes',
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    switch($campo){
                        case 'imagem_em_destaque':
                            $this->removeImage($materia, 'imagem_em_destaque');
                            $materia->imagem_em_destaque = $this->uploadImage($request, 'imagem_em_destaque');
                        break;
                        case 'capa_da_materia':
                            $this->removeImage($materia, 'capa_da_materia');
                            $materia->imagem_em_destaque = $this->uploadImage($request, 'capa_da_materia');
                        break;
                        default:
                            $materia->$campo = $request->$campo;
                        break;
                    }
                }
            }

            $materia->save();
            return response()->json($materia, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerMateriaEspecifica($id)
    {
        try{
            $materia = Materias::find($id);

            if(!$materia){
                return response()->json(['mensagem' => 'Matéria não encontrada'], 404);
            }

            $this->removeImage($materia, 'imagem_em_destaque');
            $this->removeImage($materia, 'capa_da_materia');

            $materia->delete();
            return response()->json(['mensagem' => 'Matéria removida com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
