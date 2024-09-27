<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait RemoveImage
{
    public function removeImage($model, $attribute)
    {
        if ($model->{$attribute} && Storage::disk('public')->exists($model->{$attribute})) {
            Storage::disk('public')->delete($model->{$attribute});
        }
    }
}