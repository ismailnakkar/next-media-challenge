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

    public function getWithSelect(Array $columns) {
        return $this->model->query()->select($columns)->get();
    }

    public function fetch($id, $sortBy, $sortingType) {
        return $this->model->where('id', $id)->with(['sub_categories', 'products' => function($query) use ($sortBy, $sortingType) {
            $query->select('name', 'price', 'description', 'img_path')->inOrder($sortBy, $sortingType);
        }])->first();
    }

}
