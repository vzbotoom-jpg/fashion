<?php

namespace App\Services;

use App\Models\ProductSize;
use App\Models\StockLog;

class StockService
{
    public function logStockChange($productId, $sizeId, $oldStock, $newStock, $userId, $notes = null)
    {
        $quantityChange = $newStock - $oldStock;
        $type = $this->determineStockType($quantityChange);

        return StockLog::create([
            'product_id' => $productId,
            'size_id' => $sizeId,
            'old_stock' => $oldStock,
            'new_stock' => $newStock,
            'quantity_change' => $quantityChange,
            'type' => $type,
            'changed_by' => $userId,
            'notes' => $notes,
        ]);
    }

    public function determineStockType($quantityChange)
    {
        if ($quantityChange > 0) {
            return 'add';
        } elseif ($quantityChange < 0) {
            return 'subtract';
        }
        return 'update';
    }

    public function getLowStockProducts($threshold = 10)
    {
        return ProductSize::where('stock', '<=', 'min_stock')
            ->with(['product', 'size'])
            ->get();
    }

    public function getStockHistory($productId, $sizeId = null, $limit = 50)
    {
        $query = StockLog::where('product_id', $productId)
            ->with(['size', 'changedBy']);

        if ($sizeId) {
            $query->where('size_id', $sizeId);
        }

        return $query->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function bulkUpdateStock($updates)
    {
        $results = [];
        
        foreach ($updates as $update) {
            $productSize = ProductSize::where('product_id', $update['product_id'])
                ->where('size_id', $update['size_id'])
                ->first();

            if ($productSize) {
                $oldStock = $productSize->stock;
                $productSize->update(['stock' => $update['stock']]);

                $this->logStockChange(
                    $update['product_id'],
                    $update['size_id'],
                    $oldStock,
                    $update['stock'],
                    auth()->id(),
                    'Bulk update'
                );

                $results[] = [
                    'product_id' => $update['product_id'],
                    'size_id' => $update['size_id'],
                    'success' => true,
                ];
            }
        }

        return $results;
    }
}