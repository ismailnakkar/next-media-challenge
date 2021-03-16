<?php

namespace App\Http\Controllers;

use App\Contracts\ProductManagerContract;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

    private $productManager;

    public function __construct(ProductManagerContract $productManager)
    {
        $this->productManager = $productManager;
    }

    public function navigate() {
        return view('navigate', ['categories' => Category::select('name', 'id')->get()]);
    }

    public function create() {
        return view('create', ['categories' => Category::select('name', 'id')->get()]);
    }

    public function store(CreateProductRequest $request) {
        $data = $request->validated();
        if(isset($data['category'])) {
            $data['category_id'] = $data['category'];
            unset($data['category']);
        }
        $this->productManager->createFromWeb($data);
        return back()->withStatus('The product has been successfully created!');
    }

}
