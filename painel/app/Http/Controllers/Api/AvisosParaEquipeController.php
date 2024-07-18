<?php

namespace App\Http\Controllers\Api;

use App\Models\AvisosParaEquipe;
use App\Models\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AvisosParaEquipeController extends Controller
{
    public function retornaTodosOsAvisosParaEquipe()
    {
        try{
            $avisos = AvisosParaEquipe::with(['remetente', 'destinatario'])->paginate(10);

            if($avisos->isNotEmpty()){
                return response()->json($avisos, 200);
            }else{
                return response()->json(['mensagem' => 'Nenhum aviso encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function retornaAvisoParaEquipeEspecifico($id)
    {
        try{
            $aviso = AvisosParaEquipe::where('id', $id)->first();

            if($aviso !== null){
                $aviso->load('remetente', 'destinatario');
                return response()->json($aviso, 200);
            }else{
                return response()->json(['mensagem' => 'Aviso não encontrado'], 404);
            }
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function cadastraAvisoParaEquipe(Request $request)
    {
        try{
            $validacao = $request->validate([
                'remetente' => 'required|exists:usuarios,id',
                'destinatario' => 'required|exists:usuarios,id',   
                'mensagem' => 'required',
            ]);

            $aviso = AvisosParaEquipe::create([
                'remetente' => $request->remetente,
                'destinatario' => $request->destinatario,
                'mensagem' => $request->mensagem,
            ]);

            return response()->json($aviso, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro], 500);
        }
    }

    public function atualizaAvisoParaEquipeEspecifico(Request $request, $id)
    {
        try{
            $aviso = AvisosParaEquipe::where('id', $id)->first();

            if(!$aviso){
                return response()->json(['mensagem' => 'Aviso não encontrado'], 404);
            }

            $validacao = $request->validate([
                'remente' => 'exists:usuarios,id',
                'destinatario' => 'exists:usuarios,id',
            ]);

            $camposAtualizaveis = [
                'remente',
                'destinatario',
                'mensagem'
            ];

            foreach($camposAtualizaveis as $campo){
                if($request->has($campo)){
                    $aviso->$campo = $request->$campo;
                }
            }

            $aviso->save();
            return response()->json($aviso, 200);
        }catch(ValidationException $erro){
            return response()->json(['mensagem' => 'Erro de validação', $erro->getMessage()], 400);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function removerAvisoParaEquipeEspecifico($id)
    {
        try{
            $aviso = AvisosParaEquipe::where('id', $id)->first();

            if(!$aviso){
                return response()->json(['mensagem' => 'Aviso não encontrado'], 404);
            }

            $aviso->delete();
            return response()->json(['mensagem' => 'Aviso removido com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
