<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images');
        $filteredProducts = $products->filtered()->paginate(8)->withQueryString();
        $categories = Category::get();
        $brands = Brand::get();

        return Inertia::render('User/ProductList', [
            'products' => ProductResource::collection($filteredProducts),
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
