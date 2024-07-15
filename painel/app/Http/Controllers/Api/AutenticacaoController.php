<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacaoController extends Controller
{
    public function login(Request $request)
    {
        try{
            $credenciais = $request->validate([
                'login' => 'required',
                'senha' => 'required'
            ]);
    
            if(Auth::attempt($credenciais)){
                $usuario = Auth::user();
                $token = $usuario->createToken('token')->plainTextToken;
                return response()->json($token, 200);
            }
            
            return response()->json(['mensagem' => 'Credenciais inválidas'], 401);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor',  $erro->getMessage()], 500);
        }
    }

    public function logado(Request $request)
    {
        try{
            $usuario = Auth::user();

            if($usuario){
                return response()->json($usuario, 200);
            }
            
            return response()->json(['mensagem' => 'Nenhum usuário logado'], 401);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }

    public function deslogar(Request $request)
    {
        try{
            $request->user()->tokens()->delete();
            return response()->json(['mensagem' => 'Usuário deslogado com sucesso'], 200);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }
}
