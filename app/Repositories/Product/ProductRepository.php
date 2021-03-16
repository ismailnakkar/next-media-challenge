<?php

namespace App\Repositories\Product;

interface ProductRepository {

    public function create(Array $data);

    public function find(Array $data);

    public function update($id, Array $data);

    public function getInOrder(String $sortBy, String $type);

}
