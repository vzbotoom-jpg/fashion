<?php

namespace App\Services;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function getAllImages($perPage = 20)
    {
        return Gallery::orderBy('order')->paginate($perPage);
    }

    public function getActiveImages()
    {
        return Gallery::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function createGalleryImage($data)
    {
        $imagePath = null;
        
        if (isset($data['image']) && $data['image']) {
            $imagePath = $data['image']->store('gallery', 'public');
        }

        return Gallery::create([
            'image_path' => $imagePath,
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            'category' => $data['category'] ?? null,
            'order' => $data['order'] ?? 0,
            'is_active' => $data['is_active'] ?? true,
        ]);
    }

    public function updateGalleryImage($id, $data)
    {
        $gallery = Gallery::findOrFail($id);
        
        if (isset($data['image']) && $data['image']) {
            if ($gallery->image_path) {
                Storage::delete('public/' . $gallery->image_path);
            }
            $gallery->image_path = $data['image']->store('gallery', 'public');
        }

        $gallery->update([
            'title' => $data['title'] ?? $gallery->title,
            'description' => $data['description'] ?? $gallery->description,
            'category' => $data['category'] ?? $gallery->category,
            'order' => $data['order'] ?? $gallery->order,
            'is_active' => $data['is_active'] ?? $gallery->is_active,
        ]);

        return $gallery;
    }

    public function deleteGalleryImage($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        if ($gallery->image_path) {
            Storage::delete('public/' . $gallery->image_path);
        }

        $gallery->delete();
        return true;
    }
}