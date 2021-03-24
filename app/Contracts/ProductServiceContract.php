<?php

namespace App\Contracts;

interface ProductServiceContract {

    public function create(String $name, String $description, Float $price, String $img_path, Array $categories): int;

    public function deleteProduct(int $id): void;

}
