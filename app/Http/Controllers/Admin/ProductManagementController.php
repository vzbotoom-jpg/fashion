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

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $collections = Collection::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('admin.products.create', compact('categories', 'collections', 'sizes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'collection_id' => 'nullable|exists:collections,id',
            'sizes' => 'required|array',
            'sizes.*.size_id' => 'required|exists:sizes,id',
            'sizes.*.stock' => 'required|integer|min:0',
            'sizes.*.price' => 'required|numeric|min:0',
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

    public function edit($id)
    {
        $product = Product::with(['images', 'sizes'])->findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        $collections = Collection::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('admin.products.edit', compact('product', 'categories', 'collections', 'sizes'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'collection_id' => 'nullable|exists:collections,id',
            'sizes' => 'required|array',
            'sizes.*.size_id' => 'required|exists:sizes,id',
            'sizes.*.stock' => 'required|integer|min:0',
            'sizes.*.price' => 'required|numeric|min:0',
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

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete images
        foreach ($product->images as $image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}