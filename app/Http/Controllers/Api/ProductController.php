<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetProductsRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\API\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProducts(GetProductsRequest $requestArray)
    {
        $products = $this->productService->getProducts($requestArray->validated());

        $data = [
            'books' => ProductResource::collection($products),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'total' => $products->total(),
                'per_page' => $products->perPage(),
            ],
        ];

        return $this->success("Get products successful", $data);
    }

    public function getProductDetail($id)
    {
        $book = $this->productService->getProductDetail($id);
        return $this->success("Get product's detail successful", new ProductDetailResource($book));
    }

    public function getCategories()
    {
        $categories = $this->productService->getCategories();
        return $this->success("Get categories successful", CategoryResource::collection($categories));
    }

    public function getBrands()
    {
        $brands = $this->productService->getBrands();
        return $this->success("Get brands successful", BrandResource::collection($brands));
    }
}
