<?php

namespace App\Http\Controllers;

use App\Models\Programas;
use App\Models\Usuarios;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProgramasController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosProgramas()
    {
        try{
            $programas = Programas::with(['locutor'])->paginate(10);

            if($programas->isNotEmpty()){
                return response()->json($programas, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum programa encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaProgramaEspecifico($slug)
    {
        try {
            $programa = Programas::where('slug', $slug)->first();
            
            if($programa !== null){
                $programa->load('locutor');
                return response()->json($programa, 200);
            }else{
                return response()->json(['mensagem' => 'Programa não encontrado'], 404);
            }
        } catch (\Exception $erro) {
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraPrograma(Request $request)
    {
        try {
            $validacao = $request->validate([
                'locutor' => 'required|exists:usuarios,id',
                'nome_do_programa' => 'required|unique:programas,nome_do_programa',
                'logo_do_programa' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
    
            $programa = Programas::create([
                'slug' => Str::slug($request->nome_do_programa),
                'locutor' => $request->locutor,
                'nome_do_programa' => $request->nome_do_programa,
                'logo_do_programa' => $this->uploadImage($request, 'logo_do_programa'),
            ]);

            return response()->json($programa, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function atualizaProgramaEspecifico(Request $request, $slug)
    {
        try{
            $programa = Programas::where('slug', $slug)->first();

            if(!$programa){
                return response()->json(['mensagem' => 'Programa não encontrado'], 404);
            }

            $validacao = $request->validate([
                'locutor' => 'exists:usuarios,id',
                'nome_do_programa' => 'unique:programas,nome_do_programa',
                'logo_do_programa' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            $camposAtualizaveis = [
                'locutor',
                'nome_do_programa',
                'logo_do_programa'
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    switch($campo){
                        case 'nome_do_programa':
                            $programa->slug = Str::slug($request->nome_do_programa);
                            $programa->nome_do_programa = $request->nome_do_programa;
                        break;
                        case 'logo_do_programa':
                            $this->RemoveImage($programa, 'logo_do_programa');
                            $programa->logo_do_programa = $this->uploadImage($request, 'logo_do_programa');
                        break;
                        default: 
                            $programa->$campo = $request->$campo;
                        break;
                    }
                }
            }

            $programa->save();
            return response()->json($programa, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerProgramaEspecifico($id)
    {
        try{
            $programa = Programas::find($id);

            if(!$programa){
                return response()->json(['mensagem' => 'Programa não encontrado'], 404);
            }

            $this->removeImage($programa, 'logo_do_programa');

            $programa->delete();

            return response()->json(['mensagem' => 'Programa removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
