<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'products' => ProductResource::collection($this->getSortedProducts($request->query('sortBy'), $request->query('sortingType'))),
            'categories' => CategoryResource::collection($this->sub_categories)
        ];
    }
}
