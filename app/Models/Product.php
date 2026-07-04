<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'category_id',
        'collection_id',
        'is_featured',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->sku)) {
                $product->sku = 'PRD-' . strtoupper(Str::random(8));
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes')
            ->withPivot(['stock', 'min_stock', 'price'])
            ->withTimestamps();
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function preOrders()
    {
        return $this->hasMany(PreOrder::class);
    }

    public function customOrders()
    {
        return $this->hasMany(CustomOrder::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }

    // Helper methods
    public function getTotalStockAttribute(): int
    {
        return $this->productSizes()->sum('stock');
    }

    public function getMainImageAttribute()
    {
        $image = $this->images()->first();
        return $image ? $image->image_path : null;
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function isInStock(): bool
    {
        return $this->total_stock > 0;
    }

    public function getStockForSize($sizeId): int
    {
        $productSize = $this->productSizes()
            ->where('size_id', $sizeId)
            ->first();
        return $productSize ? $productSize->stock : 0;
    }

    public function getPriceForSize($sizeId): ?float
    {
        $productSize = $this->productSizes()
            ->where('size_id', $sizeId)
            ->first();
        return $productSize ? $productSize->price : null;
    }
}