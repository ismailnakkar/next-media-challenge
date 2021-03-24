<?php

namespace App\Services;

use App\Contracts\ImageUploadServiceContract;
use Illuminate\Support\Facades\Storage;
use \Symfony\Component\HttpFoundation\File\File;
use Intervention\Image\ImageManagerStatic as Image;
use InvalidArgumentException;

class ImageUploadService implements ImageUploadServiceContract
{
    private $path;

    public function setPath(String $path): ImageUploadService
    {
        $this->path = $path;

        return $this;
    }


    public function save(int $product_id): String
    {
        $file = new File(file_exists($this->path) ? $this->path : base_path($this->path));
        if(!strstr($file->getMimeType(), 'image')) {
            throw new InvalidArgumentException("The file must be an image");
        }
        $image = Image::make($file)->encode($file->getExtension() !== 'tmp' ? $file->getExtension() : 'png');
        $path = "images/{$product_id}.{$image->extension}";
        Storage::put($path, $image);
        return $path;
    }




}
