<?php

namespace App\Repositories\Category;


interface CategoryRepository {

    public function create(Array $data);

    public function delete(int $id);

    public function find(int $id);

    public function getWithSelect(Array $columns);

    public function fetch($id, $sortBy, $sortingType);

}


