<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait RemoveImage
{
    public function RemoveImage($model, $attribute)
    {
        if ($model->{$attribute} && Storage::disk('public')->exists($model->{$attribute})) {
            Storage::disk($disk)->delete($model->{$attribute});
        }
    }
}