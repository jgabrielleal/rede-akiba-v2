<?php

namespace App\Http\Controllers;;

use App\Models\Programas;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramasController extends Controller
{
    public function retornaTodosProgramas()
    {
        $programas = Programas::with(['locutor'])->paginate(10);

        if ($programas->isNotEmpty()) {
            return response()->json($programas, 200);
        }
            
        return response()->noContent();
    }

    public function retornaProgramaEspecifico($slug)
    {
        $programa = Programas::where('slug', $slug)->first();

        if ($programa !== null) {
            $programa->load('locutor');

            return response()->json($programa, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraPrograma(Request $request)
    {
        $request->validate([
            'locutor' => 'required|exists:usuarios,id',
            'nome_do_programa' => 'required|unique:programas,nome_do_programa',
            'logo_do_programa' => 'required|string',
        ]);

        $programa = Programas::create([
            'slug' => Str::slug($request->nome_do_programa),
            'locutor' => $request->locutor,
            'nome_do_programa' => $request->nome_do_programa,
            'logo_do_programa' => $request->logo_do_programa,
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
            'locutor' => 'required|exists:usuarios,id',
            'nome_do_programa' => 'required|unique:programas,nome_do_programa',
            'logo_do_programa' => 'required|string',
        ]);

        $update = [
            'locutor' => $request->locutor,
            'nome_do_programa' => $request->nome_do_programa,
            'logo_do_programa' => $request->logo_do_programa,
        ];

        $programa->update($update);
        return response()->json($programa, 200);
    }

    public function removerProgramaEspecifico($id)
    {
        $programa = Programas::find($id);

        if (!$programa) {
            return response()->noContent();
        }

        $programa->delete();
        return response()->json(['mensagem' => 'Programa removido com sucesso'], 200);
    }
}
