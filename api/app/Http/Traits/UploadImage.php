<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait UploadImage
{
    public function uploadImage($request, $key)
    {
        $nomeDoArquivo = Str::slug(pathinfo($request->$key, PATHINFO_FILENAME)) . '-' . time() . '.' . $request->$key->extension();
        $caminhoDoArquivo = $request->$key->storeAs('public/upload-imagens', $nomeDoArquivo);
        return 'storage/upload-imagens/' . $nomeDoArquivo;
    }
}