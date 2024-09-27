<?php

namespace App\Http\Controllers;;

use App\Models\RepositorioDeArquivos;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;
use Illuminate\Http\Request;

class RepositorioDeArquivosController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodoRepositorio()
    {
        $repositorio = RepositorioDeArquivos::with(['uploader'])->paginate(10);

        if ($repositorio->isNotEmpty()) {
            return response()->json($repositorio, 200);
        } else {
            return response()->noContent();
        }
    }

    public function retornaArquivoDoRepositorioEspecifico($id)
    {
        $repositorio = RepositorioDeArquivos::where('id', $id)->first();

        if ($repositorio !== null) {
            $repositorio->load('uploader');
            return response()->json($repositorio, 200);
        } else {
            return response()->noContent();
        }
    }

    public function cadastraArquivoNoRepositorio(Request $request)
    {
        $request->validate([
            'uploader' => 'required|exists:usuarios,id',
            'nome_do_arquivo' => 'required',
            'icone_do_arquivo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'endereco_do_download' => 'required',
            'categoria' => 'required',
        ]);

        $arquivo = RepositorioDeArquivos::create([
            'uploader' => $request->uploader,
            'nome_do_arquivo' => $request->nome_do_arquivo,
            'icone_do_arquivo' => $this->uploadImage($request, 'icone_do_arquivo'),
            'endereco_do_download' => $request->endereco_do_download,
            'categoria' => $request->categoria,
        ]);

        return response()->json($arquivo, 200);
    }

    public function atualizaArquivoDoRepositorioEspecifico(Request $request, $id)
    {
        $repositorio = RepositorioDeArquivos::where('id', $id)->first();

        if (!$repositorio) {
            return response()->noContent();
        }

        $request->validate([
            'uploader' => 'exists:usuarios,id',
            'icone_do_arquivo' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $camposAtualizaveis = [
            'uploader',
            'nome_do_arquivo',
            'icone_do_arquivo',
            'endereco_do_download',
            'categoria',
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                if ($campo == 'icone_do_arquivo') {
                    $this->removeImage($repositorio, 'icone_do_arquivo');
                    $repositorio->icone_do_arquivo = $this->uploadImage($request, 'icone_do_arquivo');
                } else {
                    $repositorio->$campo = $request->$campo;
                }
            }
        }

        $repositorio->save();
        return response()->json($repositorio, 200);
    }

    public function removerArquivoDoRepositorioEspecifico($id)
    {
        $repositorio = RepositorioDeArquivos::where('id', $id)->first();

        if (!$repositorio) {
            return response()->noContent();
        }

        $this->removeImage($repositorio, 'icone_do_arquivo');
        $repositorio->delete();

        return response()->json(['mensagem' => 'Arquivo removido com sucesso'], 200);
    }
}
