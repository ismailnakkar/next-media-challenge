<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryServiceContract;
use App\Contracts\ProductServiceContract;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

    private $ProductService, $CategoryService;

    public function __construct(ProductServiceContract $ProductService, CategoryServiceContract $CategoryService)
    {
        $this->ProductService = $ProductService;
        $this->CategoryService = $CategoryService;
    }

    public function navigate()
    {
        return view('navigate', ['categories' => $this->CategoryService->getWithSelect(['name', 'id'])]);
    }

    public function create()
    {
        return view('create', ['categories' => $this->CategoryService->getWithSelect(['name', 'id'])]);
    }

    public function store(CreateProductRequest $request)
    {
        $this->ProductService->create($request->name, $request->description, $request->price, $request->file('image')->path(), $request->categories ?? []);
        return back()->withStatus('The product has been successfully created!');
    }

}
