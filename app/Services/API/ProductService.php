<?php

namespace App\Services\API;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getProducts($filter): LengthAwarePaginator
    {
        $query = Product::query()
        ->when(isset($filter['category']), function ($q) use ($filter) {
            $q->where('category_id', $filter['category']);
        })
        ->when(isset($filter['brand']), function ($q) use ($filter) {
            $q->where('brand_id', $filter['brand']);
        })
        ->when(isset($filter['keyword']), function ($q) use ($filter) {
            $q->where(function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['keyword'] . '%')
                    ->orWhere('description', 'like', '%' . $filter['keyword'] . '%')
                    ->orWhereHas('category', function ($query) use ($filter) {
                        $query->where('english_name', 'like', '%' . $filter['keyword'] . '%');
                    })
                    ->orWhereHas('brand', function ($query) use ($filter) {
                        $query->where('name', 'like', '%' . $filter['keyword'] . '%');
                    });
            });
        });

        $perPage = $filter['limit'] ?? 20;
        $products = $query->paginate($perPage);
        return $products;
    }

    public function getProductDetail(int $productId): Product
    {
        return Product::findOrFail($productId);
    }

    public function getCategories()
    {
        $categories = Category::all();
        return $categories;
    }

    public function getBrands()
    {
        $brands = Brand::all();
        return $brands;
    }
}
