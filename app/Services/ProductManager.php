<?php

namespace App\Services;

use App\Contracts\ProductManagerContract;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \Symfony\Component\HttpFoundation\File\File;
use Intervention\Image\ImageManagerStatic as Image;
use InvalidArgumentException;

class ProductManager implements ProductManagerContract {

    private $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }


    public function createFromConsole($name, $description, Float $price, $img_path, $categories) {
        $file = new File(base_path($img_path));
        if(!strstr($file->getMimeType(), 'image')) {
            throw new InvalidArgumentException("The file must be an image");
        }
        $image = Image::make($file)->encode($file->getExtension());
        return DB::transaction(function() use ($name, $description, $price, $image, $file, $categories) {
            $product = $this->product->create(['name' => $name, 'description' => $description, 'price' => $price]);
            if($categories) {
                $product->categories()->sync($categories);
            }
            $path = "images/{$product->id}.{$file->getExtension()}";
            Storage::put($path, $image);
            $product->update(['img_path' => $path]);
            return $product->id;
        }, 2);
    }

    public function createFromWeb(Array $data) {
        DB::transaction(function () use ($data) {
            $product = $this->product->create(Arr::except($data, 'categories'));
            if(isset($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }
            $image_path = $data['image']->storeAs("images", "{$product->id}.{$data['image']->guessExtension()}");
            $product->update(['img_path' => $image_path]);
        });
    }

    public function deleteProduct($id) {
        $product = $this->product->find($id);
        Storage::delete($product->img_path);
        $product->delete();
    }
}
