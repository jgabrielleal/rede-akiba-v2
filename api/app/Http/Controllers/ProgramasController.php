<?php

namespace App\Http\Controllers;;

use App\Models\Programas;

use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramasController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosProgramas()
    {
        $programas = Programas::with(['locutor'])->paginate(10);

        if ($programas->isNotEmpty()) {
            return response()->json($programas, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaProgramaEspecifico($slug)
    {
        $programa = Programas::where('slug', $slug)->first();

        if ($programa !== null) {
            $programa->load('locutor');
            return response()->json($programa, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraPrograma(Request $request)
    {
        $request->validate([
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
    }

    public function atualizaProgramaEspecifico(Request $request, $slug)
    {
        $programa = Programas::where('slug', $slug)->first();

        if (!$programa) {
            return response()->noContent();
        }

        $request->validate([
            'locutor' => 'exists:usuarios,id',
            'nome_do_programa' => 'unique:programas,nome_do_programa',
            'logo_do_programa' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $camposAtualizaveis = [
            'locutor',
            'nome_do_programa',
            'logo_do_programa'
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                switch ($campo) {
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
    }

    public function removerProgramaEspecifico($id)
    {
        $programa = Programas::find($id);

        if (!$programa) {
            return response()->noContent();
        }

        $this->removeImage($programa, 'logo_do_programa');

        $programa->delete();

        return response()->json(['mensagem' => 'Programa removido com sucesso'], 200);
    }
}
