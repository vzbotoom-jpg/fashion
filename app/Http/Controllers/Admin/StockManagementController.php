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

    public function edit($productId)
    {
        $product = Product::with(['sizes'])->findOrFail($productId);
        return view('admin.products.stock', compact('product'));
    }

    public function update(Request $request, $productId)
    {
        $validator = Validator::make($request->all(), [
            'sizes' => 'required|array',
            'sizes.*.size_id' => 'required|exists:sizes,id',
            'sizes.*.stock' => 'required|integer|min:0',
            'sizes.*.min_stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::findOrFail($productId);

        foreach ($request->sizes as $sizeData) {
            $productSize = ProductSize::where('product_id', $product->id)
                ->where('size_id', $sizeData['size_id'])
                ->first();

            if ($productSize) {
                $oldStock = $productSize->stock;
                $productSize->update([
                    'stock' => $sizeData['stock'],
                    'min_stock' => $sizeData['min_stock'],
                ]);

                $this->stockService->logStockChange(
                    $product->id,
                    $sizeData['size_id'],
                    $oldStock,
                    $sizeData['stock'],
                    auth()->id(),
                    'Admin update'
                );
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Stok produk berhasil diperbarui!');
    }

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