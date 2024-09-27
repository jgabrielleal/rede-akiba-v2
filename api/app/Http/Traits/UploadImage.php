<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

trait UploadImage
{
    public function uploadImage($request, $key)
    {
        try {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $nomeDoArquivo = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->extension();
                $caminhoDoArquivo = $file->storeAs('public/upload-imagens', $nomeDoArquivo);
                $urlCompleta = url(Storage::url($caminhoDoArquivo));
                
                return $urlCompleta;
            }

            return null;
        } catch (Exception $e) {
            return null;
        }
    }
}