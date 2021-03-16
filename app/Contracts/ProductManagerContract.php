<?php

namespace App\Contracts;

interface ProductManagerContract {

    public function createFromConsole($name, $description, Float $price, $img_path);

    public function createFromWeb(Array $data);

    public function deleteProduct($id);

}
