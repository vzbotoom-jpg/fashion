<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryImages = Gallery::where('is_active', true)
            ->orderBy('order')
            ->paginate(24);

        return view('frontend.gallery', compact('galleryImages'));
    }
}