<?php

namespace App\Contracts;

use App\Services\ImageUploadService;

interface ImageUploadServiceContract
{

    public function setPath(string $path): ImageUploadService;

    public function save(int $product_id): string;

}
