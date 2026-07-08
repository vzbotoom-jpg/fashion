<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Size;
use App\Models\ProductSize;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductManagementController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images']);

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('sku', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('status') && $request->status) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = Category::where('is_active', true)->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $collections = Collection::where('is_active', true)->orderBy('name')->get();
        $sizes = Size::where('is_active', true)->orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'collections', 'sizes'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'collection_id' => 'nullable|exists:collections,id',
            'sku' => 'nullable|string|max:50|unique:products,sku',
            // ✅ Sizes menjadi nullable (opsional)
            'sizes' => 'nullable|array',
            'sizes.*.size_id' => 'nullable|exists:sizes,id',
            'sizes.*.stock' => 'nullable|integer|min:0',
            'sizes.*.min_stock' => 'nullable|integer|min:0',
            'sizes.*.price' => 'nullable|numeric|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:5120',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = $this->productService->createProduct($request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit($id)
    {
        $product = Product::with(['images', 'sizes'])->findOrFail($id);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $collections = Collection::where('is_active', true)->orderBy('name')->get();
        $sizes = Size::where('is_active', true)->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'collections', 'sizes'));
    }

    /**
     * Update a product.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'collection_id' => 'nullable|exists:collections,id',
            'sku' => 'nullable|string|max:50|unique:products,sku,' . $id,
            // ✅ Sizes menjadi nullable (opsional)
            'sizes' => 'nullable|array',
            'sizes.*.size_id' => 'nullable|exists:sizes,id',
            'sizes.*.stock' => 'nullable|integer|min:0',
            'sizes.*.min_stock' => 'nullable|integer|min:0',
            'sizes.*.price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = $this->productService->updateProduct($id, $request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Delete a product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // Delete product sizes
        $product->sizes()->detach();

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Delete a product image.
     */
    public function deleteImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Toggle product featured status.
     */
    public function toggleFeatured($id)
    {
        $product = Product::findOrFail($id);
        $product->is_featured = !$product->is_featured;
        $product->save();

        return redirect()->back()
            ->with('success', 'Status unggulan produk berhasil diubah!');
    }

    /**
     * Toggle product active status.
     */
    public function toggleActive($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        return redirect()->back()
            ->with('success', 'Status produk berhasil diubah!');
    }

    /**
     * Duplicate a product.
     */
    public function duplicate($id)
    {
        $originalProduct = Product::with(['images', 'sizes'])->findOrFail($id);
        
        // Create new product
        $newProduct = $originalProduct->replicate();
        $newProduct->name = $originalProduct->name . ' (Copy)';
        $newProduct->sku = 'PRD-' . strtoupper(Str::random(8));
        $newProduct->slug = Str::slug($newProduct->name) . '-' . Str::random(4);
        $newProduct->is_active = false;
        $newProduct->save();

        // Duplicate sizes
        foreach ($originalProduct->sizes as $size) {
            $newProduct->sizes()->attach($size->id, [
                'stock' => $size->pivot->stock,
                'min_stock' => $size->pivot->min_stock,
                'price' => $size->pivot->price,
            ]);
        }

        // Duplicate images
        foreach ($originalProduct->images as $image) {
            $newPath = 'products/' . Str::random(40) . '.jpg';
            Storage::disk('public')->copy($image->image_path, $newPath);
            $newProduct->images()->create(['image_path' => $newPath]);
        }

        return redirect()->route('admin.products.edit', $newProduct->id)
            ->with('success', 'Produk berhasil diduplikasi!');
    }

    /**
     * Get product sizes with stock (for API/AJAX).
     */
    public function getSizes($id)
    {
        $product = Product::with(['sizes'])->findOrFail($id);
        $sizes = $product->sizes->map(function ($size) {
            return [
                'id' => $size->id,
                'name' => $size->name,
                'code' => $size->code,
                'stock' => $size->pivot->stock,
                'min_stock' => $size->pivot->min_stock,
                'price' => $size->pivot->price,
            ];
        });

        return response()->json($sizes);
    }
}