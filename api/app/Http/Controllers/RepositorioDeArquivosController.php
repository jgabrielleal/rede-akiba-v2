<?php

namespace App\Http\Controllers;;

use App\Models\RepositorioDeArquivos;
use Illuminate\Http\Request;

class RepositorioDeArquivosController extends Controller
{
    public function retornaTodoRepositorio()
    {
        $repositorio = RepositorioDeArquivos::with(['uploader'])->paginate(10);

        if ($repositorio->isNotEmpty()) {
            return response()->json($repositorio, 200);
        }
            
        return response()->noContent();
    }

    public function retornaArquivoDoRepositorioEspecifico($id)
    {
        $repositorio = RepositorioDeArquivos::where('id', $id)->first();

        if ($repositorio !== null) {
            $repositorio->load('uploader');
            
            return response()->json($repositorio, 200);
        }
            
        return response()->noContent();
    }

    public function cadastraArquivoNoRepositorio(Request $request)
    {
        $request->validate([
            'uploader' => 'required|exists:usuarios,id',
            'nome_do_arquivo' => 'required|string',
            'icone_do_arquivo' => 'required|string',
            'endereco_do_download' => 'required|string',
            'categoria' => 'required|string',
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
            'nome_do_arquivo' => 'required|string',
            'icone_do_arquivo' => 'required|string',
            'endereco_do_download' => 'required|string',
            'categoria' => 'required|string',
        ]);

        $update = [
            'nome_do_arquivo' => $request->nome_do_arquivo,
            'icone_do_arquivo' => $request->icone_do_arquivo,
            'endereco_do_download' => $request->endereco_do_download,
            'categoria' => $request->categoria,
        ];

        $repositorio->update($update);
        return response()->json($repositorio, 200);
    }

    public function removerArquivoDoRepositorioEspecifico($id)
    {
        $repositorio = RepositorioDeArquivos::where('id', $id)->first();

        if (!$repositorio) {
            return response()->noContent();
        }

        $repositorio->delete();
        return response()->json(['mensagem' => 'Arquivo removido com sucesso'], 200);
    }
}
