<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function detail(Request $request, Product $product)
    {
        $product = Product::with('category', 'brand', 'product_images')
            ->where('id', $product->id)
            ->first();
        return Inertia::render('User/ProductDetail', ['product' => $product]);
    }
}
