<?php

namespace App\Http\Controllers\Api;

use App\Models\RepositorioDeArquivos;
use App\Models\Usuarios;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepositorioDeArquivosController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodoRepositorio()
    {
        try{
            $repositorio = RepositorioDeArquivos::with('uploader')->paginate(10);

            if($repositorio->isNotEmpty()){
                return response()->json($repositorio, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum arquivo encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function retornaArquivoDoRepositorioEspecifico($id)
    {
        try{
            $repositorio = RepositorioDeArquivos::where('id', $id)->first();

            if($repositorio !== null){
                $repositorio->load('uploader');
                return response()->json($repositorio, 200);
            }else{
                return response()->json(['mensagem' => 'Arquivo não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function cadastraArquivoNoRepositorio(Request $request)
    {
        try{
            $validacao = $request->validate([
                'uploader' => 'required|exists:usuarios,id',
                'nome_do_arquivo' => 'required',
                'icone_do_arquivo' => 'required|image|mimes:jpeg,png,jpg,gif',
                'endereco_de_download' => 'required',
                'categoria' => 'required',
            ]); 

            $arquivo = RepositorioDeArquivos::create([
                'uploader' => $request->uploader,
                'nome_do_arquivo' => $request->nome_do_arquivo,
                'icone_do_arquivo' => $this->uploadImage($request, 'icone_do_arquivo'),
                'endereco_de_download' => $request->endereco_de_download,
                'categoria' => $request->categoria,
            ]);

            return response()->json($arquivo, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function atualizaArquivoDoRepositorioEspecifico(Request $request, $id)
    {
        try{
            $repositorio = RepositorioDeArquivos::where('id', $id)->first();

            if(!$repositorio){
                return response()->json(['mensagem' => 'Arquivo não encontrado'], 404);
            }

            $validacao = $request->validate([
                'uploader' => 'exists:usuarios,id',
                'icone_do_arquivo' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            $camposAtualizaveis = [
                'uploader',
                'nome_do_arquivo',
                'icone_do_arquivo',
                'endereco_de_download',
                'categoria',
            ];
        
            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    if($campo == 'icone_do_arquivo'){
                        $this->removeImage($repositorio, 'icone_do_arquivo');
                        $repositorio->icone_do_arquivo = $this->uploadImage($request, 'icone_do_arquivo');
                    }else{
                        $repositorio->$campo = $request->$campo;
                    }
                }
            }

            $repositorio->save();
            return response()->json($repositorio, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->errors()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function removerArquivoDoRepositorioEspecifico($id)
    {
        try{
            $repositorio = RepositorioDeArquivos::where('id', $id)->first();

            if(!$repositorio){
                return response()->json(['mensagem' => 'Arquivo não encontrado'], 404);
            }

            $this->removeImage($repositorio, 'icone_do_arquivo');
            $repositorio->delete();

            return response()->json(['mensagem' => 'Arquivo removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor'], 500);
        }
    }
}
