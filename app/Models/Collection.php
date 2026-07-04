<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getProductCountAttribute(): int
    {
        return $this->products()->where('is_active', true)->count();
    }

    public function getMainImageAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }
}