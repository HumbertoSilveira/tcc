<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait UploadTrait
{
    public function uploadImage(UploadedFile $file, string $path, array $dimensoes)
    {
        try{
            Storage::makeDirectory($path);

            $extension = strtolower($file->getClientOriginalExtension());
            $name = Str::random().'.'.$extension;

            $img = Image::make($file);
            $img->interlace()->resize($dimensoes['width'], $dimensoes['height'] ?? null, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($path.$name, $img->stream($extension, 60));

            return [
                'success' => true,
                'arquivo' => $name
            ];

        }catch(\Exception $e) {
            return [
                'success' => false,
                'erro' => $e->getMessage()
            ];
        }
    }
}