<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes')
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
}