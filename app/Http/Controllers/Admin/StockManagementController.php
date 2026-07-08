<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockManagementController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    /**
     * Display a listing of all products with stock.
     */
    public function index()
    {
        $products = Product::with(['sizes', 'category'])
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(20);

        return view('admin.products.stock-index', compact('products'));
    }

    /**
     * Show the form for editing stock of a specific product.
     */
    public function edit($productId)
    {
        $product = Product::with(['sizes'])->findOrFail($productId);
        return view('admin.products.stock', compact('product'));
    }

    /**
     * Update stock for a specific product.
     */
    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // ✅ Validasi: sizes tidak wajib jika produk tidak memiliki ukuran
        $rules = [
            'sizes' => 'nullable|array',
            'sizes.*.size_id' => 'nullable|exists:sizes,id',
            'sizes.*.stock' => 'nullable|integer|min:0',
            'sizes.*.min_stock' => 'nullable|integer|min:0',
            'sizes.*.price' => 'nullable|numeric|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Jika tidak ada data sizes, redirect dengan pesan
        if (!$request->has('sizes') || empty($request->sizes)) {
            return redirect()->back()
                ->with('warning', 'Produk ini belum memiliki ukuran. Silakan tambahkan ukuran terlebih dahulu.');
        }

        foreach ($request->sizes as $sizeData) {
            if (!isset($sizeData['size_id'])) {
                continue;
            }

            $productSize = ProductSize::where('product_id', $product->id)
                ->where('size_id', $sizeData['size_id'])
                ->first();

            if ($productSize) {
                $oldStock = $productSize->stock;
                $productSize->update([
                    'stock' => $sizeData['stock'] ?? 0,
                    'min_stock' => $sizeData['min_stock'] ?? 5,
                    'price' => $sizeData['price'] ?? null,
                ]);

                $this->stockService->logStockChange(
                    $product->id,
                    $sizeData['size_id'],
                    $oldStock,
                    $sizeData['stock'] ?? 0,
                    auth()->id(),
                    'Admin update'
                );
            }
        }

        return redirect()->route('admin.products.stock.index')
            ->with('success', 'Stok produk berhasil diperbarui!');
    }

    /**
     * Bulk update stock for multiple products.
     */
    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.size_id' => 'required|exists:sizes,id',
            'products.*.stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $results = [];
        foreach ($request->products as $productData) {
            $productSize = ProductSize::where('product_id', $productData['product_id'])
                ->where('size_id', $productData['size_id'])
                ->first();

            if ($productSize) {
                $oldStock = $productSize->stock;
                $productSize->update(['stock' => $productData['stock']]);

                $this->stockService->logStockChange(
                    $productData['product_id'],
                    $productData['size_id'],
                    $oldStock,
                    $productData['stock'],
                    auth()->id(),
                    'Bulk update'
                );

                $results[] = [
                    'product_id' => $productData['product_id'],
                    'size_id' => $productData['size_id'],
                    'success' => true,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil diperbarui!',
            'results' => $results
        ]);
    }
}