<?php

namespace App\Services;

use App\Contracts\ImageUploadServiceContract;
use Illuminate\Contracts\Filesystem\Filesystem;
use Intervention\Image\ImageManagerStatic as Image;
use InvalidArgumentException;
use \Symfony\Component\HttpFoundation\File\File;

class ImageUploadService implements ImageUploadServiceContract
{
    private $path;
    private $storage;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage;
    }

    public function setPath(string $path): ImageUploadService
    {
        $this->path = $path;

        return $this;
    }

    public function save(int $product_id): string
    {
        $file = new File(file_exists($this->path) ? $this->path : base_path($this->path));
        if (!strstr($file->getMimeType(), 'image')) {
            throw new InvalidArgumentException("The file must be an image");
        }
        $image = Image::make($file)->encode($file->getExtension() !== 'tmp' ? $file->getExtension() : 'png');
        $path = "images/{$product_id}.{$image->extension}";
        $this->storage->put($path, $image);

        return $path;
    }

}
