<?php

namespace App\Services;

use App\Contracts\ImageUploadServiceContract;
use App\Contracts\ProductServiceContract;
use App\Repositories\Product\ProductRepository;

class ProductService implements ProductServiceContract
{

    private $product;

    private $imageService;

    public function __construct(ProductRepository $product, ImageUploadServiceContract $imageService)
    {
        $this->product = $product;
        $this->imageService = $imageService;
    }

    public function create(string $name, string $description, float $price, string $img_path, array $categories = []): int
    {
        $this->product->beginTransaction();
        $product = $this->product->create(['name' => $name, 'description' => $description, 'price' => $price]);
        if ($categories) {
            $this->product->addCategories($product->id, $categories);
        }
        $path = $this->imageService->setPath($img_path)->save($product->id);
        $this->product->update($product->id, ['img_path' => $path]);
        $this->product->commitChanges();

        return $product->id;
    }

    public function deleteProduct(int $id): void
    {
        $this->product->delete($id);
    }

}
