<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class YandexStorageService
{
    public function uploadFile($file)
    {
        if ($file && $file->isValid()) {
            $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = 'apps/images/' . $uniqueFileName;
    
            Storage::disk('yandex')->put($filePath, fopen($file->getRealPath(), 'r'));
    
            return Storage::disk('yandex')->url($filePath);
        } else if ($file) {
            return false;
        }
        return null;
    }
}