<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceContract {

    public function create(String $name, int $parent): int;

    public function delete(int $id): void;

    public function getWithSelect(Array $columns): Collection;

}
