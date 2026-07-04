<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::where('is_active', true)
            ->withCount(['products' => function($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.collections.index', compact('collections'));
    }

    public function show($slug)
    {
        $collection = Collection::where('slug', $slug)
            ->where('is_active', true)
            ->with(['products' => function($query) {
                $query->where('is_active', true)->with(['images', 'category']);
            }])
            ->firstOrFail();

        return view('frontend.collections.show', compact('collection'));
    }
}