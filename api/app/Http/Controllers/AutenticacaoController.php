<?php

namespace App\Http\Controllers;;

use App\Models\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AutenticacaoController extends Controller
{
    public function login(Request $request)
    {
        try{
            $request->validate([
                'login' => 'required|exists:usuarios,login',
                'senha' => 'required',
            ]);
        
            $usuario = Usuarios::where('login', $request->login)->first();
            
            if ($usuario->login === $request->login && $usuario->senha === $request->senha) {
                $token = $usuario->createToken('token-name')->plainTextToken;
                return response()->json(['token' => $token], 200);
            }        
    
            return response()->json(['mensagem' => 'Credenciais invalidas'], 401);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', $erro->getMessage()], 500);
        }
    }   

    public function logado(Request $request)
    {
        try{
            $token = $request->input('token');
            if (!$token) {
                return response()->json(['mensagem' => 'Token não fornecido'], 400);
            }
        
            $tokenModel = PersonalAccessToken::findToken($token);
            if (!$tokenModel) {
                return response()->json(['mensagem' => 'Token inválido ou expirado'], 401);
            }
        
            $usuario = $tokenModel->tokenable; 
            if ($usuario) {
                return response()->json($usuario, 200);
            }
        
            return response()->json(['mensagem' => 'Nenhum usuário logado'], 401);
        }catch(\Exception $erro){
            return response()->json(['mensagem' => 'Erro interno do servidor', 'erro' => $erro->getMessage()], 500);
        }
    }

    public function deslogar(Request $request)
    {
        try {
            $token = $request->input('token'); 
            if (!$token) {
                return response()->json(['mensagem' => 'Token não fornecido'], 400);
            }

            $tokenModel = PersonalAccessToken::findToken($token);
            if ($tokenModel) {
                $tokenModel->delete(); 
                return response()->json(['mensagem' => 'Token invalidado com sucesso'], 200);
            }
    
            return response()->json(['mensagem' => 'Token não encontrado'], 404);
        } catch (\Exception $erro) {
            return response()->json(['mensagem' => 'Erro interno do servidor', 'erro' => $erro->getMessage()], 500);
        }
    }
}
