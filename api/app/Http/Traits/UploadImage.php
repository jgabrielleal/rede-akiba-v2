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
            if ($request->hasFile($key) && $request->file($key)->isValid()) {
                $file = $request->file($key);

                // Verifica a extensão do arquivo
                if (!in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    throw new Exception('Formato de imagem inválido');
                }

                $nomeDoArquivo = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->extension();
                $caminhoDoArquivo = $file->storeAs('public/upload-imagens', $nomeDoArquivo);
                $urlCompleta = url(Storage::url($caminhoDoArquivo));
                
                return $urlCompleta;
            }

            return null;
        } catch (Exception $e) {
            Log::error('Erro no upload da imagem: ' . $e->getMessage());
            return null;
        }
    }
}
