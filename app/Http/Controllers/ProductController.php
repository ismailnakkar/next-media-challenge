<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryManagerContract;
use App\Contracts\ProductManagerContract;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

    private $productManager, $categoryManager;

    public function __construct(ProductManagerContract $productManager, CategoryManagerContract $categoryManager)
    {
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
    }

    public function navigate() {
        return view('navigate', ['categories' => $this->categoryManager->getWithSelect(['name', 'id'])]);
    }

    public function create() {
        return view('create', ['categories' => $this->categoryManager->getWithSelect(['name', 'id'])]);
    }

    public function store(CreateProductRequest $request) {
        $this->productManager->createFromWeb($request->validated());
        return back()->withStatus('The product has been successfully created!');
    }

}
