<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EloquentProduct implements ProductRepository
{

    private $model;
    private $storage;

    public function __construct(Product $model, Filesystem $storage)
    {
        $this->model = $model;
        $this->storage = $storage;
    }

    public function create(array $data): Product
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function getInOrder(string $sortBy, string $type): Collection
    {
        return $this->model->query()->orderBy($sortBy, $type)->get();
    }

    public function find(int $id): Product
    {
        return $this->model->findOrFail($id);
    }

    public function delete(int $id): void
    {
        $product = $this->find($id);
        $this->storage->delete($product->img_path);
        $product->delete();
    }

    public function addCategories(int $id, array $categories): void
    {
        $this->model->find($id)->categories()->sync($categories);
    }

    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commitChanges(): void
    {
        DB::commit();
    }

}
