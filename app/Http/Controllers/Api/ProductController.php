<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Product\SearchRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController
{
    public function search(SearchRequest $request, ProductService $productService)
    {
        $product = $productService->search($request->input('search'));

        return new ProductResource($product);
    }
}