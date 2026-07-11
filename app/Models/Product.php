<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Product extends Model
{
    use Auditable;

    protected $fillable = [
        'category_id', 'name', 'slug', 'sku', 'short_description', 
        'long_description', 'price', 'sale_price', 'stock_quantity', 
        'is_featured', 'status', 'image', 'is_out_of_stock',
        'rating', 'reviews_count', 'ingredients', 'weight'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_featured', true);
    }
}
