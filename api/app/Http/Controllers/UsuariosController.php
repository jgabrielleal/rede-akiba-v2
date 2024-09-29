<?php

namespace App\Http\Controllers;;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function retornaTodosUsuarios()
    {
        $usuarios = Usuarios::paginate(10);
        if ($usuarios->isNotEmpty()) {
            return response()->json($usuarios, 200);
        }

        return response()->noContent();
    }

    public function retornaUsuarioEspecifico($slug)
    {
        $usuario = Usuarios::where('slug', $slug)->first();

        if ($usuario) {
            return response()->json($usuario, 200);
        }

        return response()->noContent();
    }

    public function cadastrarUsuario(Request $request)
    {
        $request->validate([
            'login' => 'required|unique:usuarios',
            'senha' => 'required|string',
            'niveis_de_acesso' => 'required|string',
            'nome' => 'required|string',
            'apelido' => 'required|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'idade' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'pais' => 'required|string',
        ]);

        $usuario = Usuarios::create([
            'slug' => Str::slug($request->apelido, '-'),
            'ativo' => 1,
            'login' => $request->login,
            'senha' => Hash::make($request->senha),
            'niveis_de_acesso' => $request->niveis_de_acesso,
            'nome' => $request->nome,
            'apelido' => $request->apelido,
            'email' => $request->email,
            'idade' => $request->idade,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
        ]);

        return response()->json($usuario, 200);
    }

    public function atualizaUsuarioEspecifico(Request $request, $slug)
    {
        $usuario = Usuarios::where('slug', $slug)->first();

        if (!$usuario) {
            return response()->noContent();
        }

        $request->validate([
            'ativo' => 'required|string',
            'login' => 'required|unique:usuarios',
            'senha' => 'required|string',
            'niveis_de_acesso' => 'required|string',
            'avatar' => 'required|string',
            'nome' => 'required|string',
            'apelido' => 'required|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'idade' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'pais' => 'required|string',
            'biografia' => 'required|string',
            'redes_sociais' => 'required|string',
            'gostos' => 'required|string',
        ]);
        $update = [
            'ativo' => $request->ativo,
            'login' => $request->login,
            'senha' => Hash::make($request->senha),
            'niveis_de_acesso' => $request->niveis_de_acesso,
            'avatar' => $request->avatar,
            'nome' => $request->nome,
            'apelido' => $request->apelido,
            'email' => $request->email,
            'idade' => $request->idade,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'biografia' => $request->biografia,
            'redes_sociais' => $request->redes_sociais,
            'gostos' => $request->gostos,
        ];

        $usuario->update($update);
        return response()->json($usuario, 200);
    }

    public function removerUsuarioEspecifico($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->noContent();
        }

        $usuario->delete();
        return response()->json(['mensagem' => 'Usuário removido com sucesso'], 200);
    }
}
