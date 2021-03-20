<?php

namespace App\Repositories\Product;

use App\Models\Product;

class EloquentProduct implements ProductRepository {

    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function create(Array $data) {
        return $this->model->create($data);
    }

    public function update($id, Array $data) {
        return $this->model->findOrFail($id)->update($data);
    }

    public function getInOrder(String $sortBy, String $type) {
        return $this->model->query()->orderBy($sortBy, $type)->get();
    }

    public function find($id) {
        return $this->model->findOrFail($id);
    }


}
