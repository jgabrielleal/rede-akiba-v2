<?php

namespace App\Http\Controllers;;

use App\Models\Usuarios;
use App\Http\Traits\UploadImage;
use App\Http\Traits\RemoveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    use UploadImage;
    use RemoveImage;

    public function retornaTodosUsuarios()
    {
        $usuarios = Usuarios::paginate(10);
        if ($usuarios->isNotEmpty()) {
            return response()->json($usuarios, 200);
        } else {
            return response()->noContent();
        }
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
            'senha' => 'required',
            'niveis_de_acesso' => 'required',
            'nome' => 'required',
            'apelido' => 'required|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'idade' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'pais' => 'required',
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

        return response()->json(['mensagem' => 'Usuário cadastrado com sucesso', $usuario], 200);
    }

    public function atualizaUsuarioEspecifico(Request $request, $slug)
    {
        $usuario = Usuarios::where('slug', $slug)->first();

        if (!$usuario) {
            return response()->noContent();
        }

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $camposAtualizaveis = [
            'ativo',
            'login',
            'senha',
            'niveis_de_acesso',
            'avatar',
            'nome',
            'apelido',
            'email',
            'idade',
            'cidade',
            'estado',
            'pais',
            'biografia',
            'redes_sociais',
            'gostos'
        ];

        foreach ($camposAtualizaveis as $campo) {
            if ($request->has($campo)) {
                switch ($campo) {
                    case 'senha':
                        $usuario->senha = Hash::make($request->senha);
                        break;
                    case 'apelido':
                        $usuario->slug = Str::slug($request->apelido);
                        break;
                    case 'avatar':
                        $this->RemoveImage($usuario, 'avatar');
                        $this->uploadImage($request, 'avatar');
                        break;
                    default:
                        $usuario->$campo = $request->$campo;
                        break;
                }
            }
        }

        $usuario->save();
        return response()->json($usuario, 200);
    }

    public function removerUsuarioEspecifico($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->noContent();
        }

        $this->RemoveImage($usuario, 'avatar');

        $usuario->delete();

        return response()->json(['mensagem' => 'Usuário removido com sucesso'], 200);
    }
}
