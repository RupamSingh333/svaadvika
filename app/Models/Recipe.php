<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'featured_image',
        'gallery_images',
        'youtube_url',
        'category',
        'difficulty',
        'diet_type',
        'spice_level',
        'duration',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_markup',
    ];

    protected $casts = [
        'gallery_images' => 'array',
    ];
}
