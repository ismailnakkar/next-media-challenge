<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentProduct implements ProductRepository {

    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function create(Array $data): Product
    {
        return $this->model->create($data);
    }

    public function update(int $id, Array $data): bool
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function getInOrder(String $sortBy, String $type): Collection {
        return $this->model->query()->orderBy($sortBy, $type)->get();
    }

    public function find(int $id): Product {
        return $this->model->findOrFail($id);
    }


}
