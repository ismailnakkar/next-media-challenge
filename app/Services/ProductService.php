<?php

namespace App\Services;

use App\Contracts\ImageUploadServiceContract;
use App\Contracts\ProductServiceContract;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductService implements ProductServiceContract
{

    private $product;

    private $imageService;

    public function __construct(ProductRepository $product, ImageUploadServiceContract $imageService)
    {
        $this->product = $product;
        $this->imageService = $imageService;
    }


    public function create(String $name, String $description, Float $price, String $img_path, Array $categories): int
    {
        DB::beginTransaction();

        $product = $this->product->create(['name' => $name, 'description' => $description, 'price' => $price]);
        if($categories) {
            $product->categories()->sync($categories);
        }
        $path = $this->imageService->setPath($img_path)->save($product->id);
        $product->update(['img_path' => $path]);
        DB::commit();

        return $product->id;
    }

    public function deleteProduct(int $id): void
    {
        $product = $this->product->find($id);
        Storage::delete($product->img_path);
        $product->delete();
    }
}
