<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'category_id',
    'medium',
    'price',
    'image',
    'description',
    'is_sold',
    'is_featured',
    'artist_id',
];

    protected $casts = [
        'is_sold' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
