<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Collection;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with(['category', 'images'])
            ->limit(8)
            ->get();

        $newProducts = Product::where('is_active', true)
            ->with(['category', 'images'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $collections = Collection::where('is_active', true)
            ->with(['products' => function($query) {
                $query->where('is_active', true)->limit(4);
            }])
            ->limit(4)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->limit(6)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->limit(6)
            ->get();

        $galleryImages = Gallery::where('is_active', true)
            ->orderBy('order')
            ->limit(12)
            ->get();

        return view('frontend.home', compact(
            'featuredProducts',
            'newProducts',
            'collections',
            'categories',
            'testimonials',
            'galleryImages'
        ));
    }
}