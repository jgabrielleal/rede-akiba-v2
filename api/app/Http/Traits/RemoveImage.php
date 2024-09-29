<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait RemoveImage
{
    public function removeImage($model, $attribute)
    {
        // Verifica se o atributo contém uma URL válida
        if ($model->{$attribute}) {
            // Extrai o caminho relativo da URL completa
            $caminhoRelativo = str_replace(url('/storage'), '', $model->{$attribute});

            // Verifica se o arquivo existe no disco público
            if (Storage::disk('public')->exists($caminhoRelativo)) {
                try {
                    Storage::disk('public')->delete($caminhoRelativo);
                } catch (\Exception $e) {
                    Log::error('Erro ao remover a imagem: ' . $e->getMessage());
                }
            }
        }
    }
}
