<?php


namespace App\Services;

use App\Contracts\CategoryManagerContract;
use App\Repositories\Category\CategoryRepository;

class CategoryManager implements CategoryManagerContract {

    private $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function create($name, $parent) {
        return $this->category->create(['name' => $name, 'parent_category' => $parent])->id;
    }

    public function delete($id): void {
        $this->category->find($id)->delete();
    }

    public function getWithSelect(Array $columns) {
        return $this->category->getWithSelect($columns);
    }
}
