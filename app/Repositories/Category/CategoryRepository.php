<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepository {

    public function create(Array $data): Category;

    public function delete(int $id): void;

    public function find(int $id): Category;

    public function getWithSelect(Array $columns): Collection;

    public function fetch(int $id, String $sortBy, String $sortingType): Category;

}


