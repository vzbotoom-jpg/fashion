<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        $products = $this->productService->getFilteredProducts($request);

        return view('frontend.products.index', compact('products', 'categories', 'sizes'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'images', 'sizes', 'customOrders'])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['images'])
            ->limit(4)
            ->get();

        $sizes = Size::where('is_active', true)->get();

        return view('frontend.products.show', compact('product', 'relatedProducts', 'sizes'));
    }
}