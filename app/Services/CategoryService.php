<?php

namespace App\Services;

use App\Contracts\CategoryServiceContract;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService implements CategoryServiceContract
{

    private $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function create(string $name, int $parent): int
    {
        return $this->category->create(['name' => $name, 'parent_category' => $parent ? $parent : null])->id;
    }

    public function delete(int $id): void
    {
        $this->category->find($id)->delete();
    }

    public function getWithSelect(array $columns): Collection
    {
        return $this->category->getWithSelect($columns);
    }
}
