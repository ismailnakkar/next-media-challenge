<?php
namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Http\Resources\ProductResource;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FetchController extends Controller
{

    private $product, $category;

    public function __construct(ProductRepository $product, CategoryRepository $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->query('category')) {
            return new DataResource($this
                    ->category
                    ->fetch($request->query('category'), $request->query('sortBy'), $request->query('sortingType')));
        } else {
            return ProductResource::collection($this
                    ->product
                    ->getInOrder($request->query('sortBy'), $request->query('sortingType')));
        }
    }
}
