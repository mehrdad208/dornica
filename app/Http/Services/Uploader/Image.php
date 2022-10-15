<?php

namespace App\Http\Services\Uploader;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Image
{
    public static function upload($image, $basePath, $diskType)
    {
      

        if (!is_null($image)) {
            Storage::disk($diskType)->put($basePath, File::get($image));
        }
    }
   
}