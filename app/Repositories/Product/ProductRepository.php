<?php

namespace App\Repositories\Product;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Product;

interface ProductRepository {

    public function create(Array $data): Product;

    public function find(int $id): Product;

    public function update(int $id, Array $data): bool;

    public function getInOrder(String $sortBy, String $type): Collection;

    public function delete(int $id): void;

}
