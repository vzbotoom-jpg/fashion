<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Gallery;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->limit(6)
            ->get();

        $galleryImages = Gallery::where('is_active', true)
            ->orderBy('order')
            ->limit(8)
            ->get();

        return view('frontend.about', compact('testimonials', 'galleryImages'));
    }
}