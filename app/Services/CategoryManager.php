<?php


namespace App\Services;

use App\Contracts\CategoryManagerContract;
use App\Models\Category;

class CategoryManager implements CategoryManagerContract {

    public function create($name, int $parent) {
        return Category::create(array_merge(['name' => $name], $parent ? ['parent_category' => $parent] : []))->id;
    }

    public function delete($id): void {
        Category::findOrFail($id)->delete();
    }
}
