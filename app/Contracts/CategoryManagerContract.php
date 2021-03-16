<?php

namespace App\Contracts;

interface CategoryManagerContract {

    public function create($name, int $parent);

    public function delete($id): void;

}
