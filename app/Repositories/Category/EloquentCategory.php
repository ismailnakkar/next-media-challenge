<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategory implements CategoryRepository
{

    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Category
    {
        return $this->model->create($data);
    }

    public function delete(int $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function find(int $id): Category
    {
        return $this->model->findOrFail($id);
    }

    public function getWithSelect(array $columns): Collection
    {
        return $this->model->query()->select($columns)->get();
    }

    public function fetch(int $id, string $sortBy, string $sortingType): Category
    {
        return $this->model->where('id', $id)->with(['sub_categories', 'products' => function ($query) use ($sortBy, $sortingType) {
            $query->select('name', 'price', 'description', 'img_path')->inOrder($sortBy, $sortingType);
        }])->first();
    }

}
