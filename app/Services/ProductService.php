<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function getAllProducts($filters = [])
    {
        $query = Product::with(['category', 'images']);

        if (isset($filters['category']) && $filters['category']) {
            $query->where('category_id', $filters['category']);
        }

        if (isset($filters['collection']) && $filters['collection']) {
            $query->where('collection_id', $filters['collection']);
        }

        if (isset($filters['search']) && $filters['search']) {
            $query->where(function($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (isset($filters['min_price']) && $filters['min_price']) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price']) && $filters['max_price']) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (isset($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        return $query->paginate($filters['per_page'] ?? 15);
    }

    public function createProduct($data)
    {
        $product = Product::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'collection_id' => $data['collection_id'] ?? null,
            'is_featured' => $data['is_featured'] ?? false,
            'is_active' => $data['is_active'] ?? true,
        ]);

        // Save sizes
        if (isset($data['sizes']) && is_array($data['sizes'])) {
            foreach ($data['sizes'] as $sizeData) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_id' => $sizeData['size_id'],
                    'stock' => $sizeData['stock'] ?? 0,
                    'min_stock' => $sizeData['min_stock'] ?? 5,
                    'price' => $sizeData['price'] ?? $data['price'],
                ]);
            }
        }

        // Save images
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return $product->load(['images', 'sizes']);
    }

    public function updateProduct($id, $data)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'collection_id' => $data['collection_id'] ?? null,
            'is_featured' => $data['is_featured'] ?? false,
            'is_active' => $data['is_active'] ?? true,
        ]);

        // Update sizes
        if (isset($data['sizes']) && is_array($data['sizes'])) {
            foreach ($data['sizes'] as $sizeData) {
                ProductSize::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'size_id' => $sizeData['size_id'],
                    ],
                    [
                        'stock' => $sizeData['stock'] ?? 0,
                        'min_stock' => $sizeData['min_stock'] ?? 5,
                        'price' => $sizeData['price'] ?? $data['price'],
                    ]
                );
            }
        }

        // Update images
        if (isset($data['images']) && is_array($data['images'])) {
            $maxOrder = $product->images()->max('order') ?? -1;
            foreach ($data['images'] as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'order' => $maxOrder + $index + 1,
                    'is_primary' => false,
                ]);
            }
        }

        return $product->load(['images', 'sizes']);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        foreach ($product->images as $image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete();
        }

        $product->sizes()->detach();
        $product->delete();

        return true;
    }

    public function updateStock($productId, $sizeId, $quantity)
    {
        $productSize = ProductSize::where('product_id', $productId)
            ->where('size_id', $sizeId)
            ->firstOrFail();

        $productSize->update(['stock' => $quantity]);
        
        return $productSize;
    }

    public function getFilteredProducts($request)
    {
        $query = Product::where('is_active', true)->with(['category', 'images']);

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('collection') && $request->collection) {
            $query->where('collection_id', $request->collection);
        }

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    $query->withCount('orderItems')->orderBy('order_items_count', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        return $query->paginate($request->per_page ?? 12);
    }
}