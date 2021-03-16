<?php

namespace App\Repositories\Category;

use App\Models\Category;

class EloquentCategory implements CategoryRepository {

    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function create(Array $data) {
        return $this->model->create($data);
    }

    public function delete(int $id) {
        return $this->model->findOrFail($id)->delete();
    }

    public function find(int $id) {
        return $this->model->findOrFail($id);
    }

    public function getWithSelect(Array ...$columns) {
        return $this->model->query()->select($columns)->get();
    }

}
