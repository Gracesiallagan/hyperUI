<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'category_id',
    'medium',
    'price',
    'stock',
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

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $path = ltrim($this->image, '/');
        $path = preg_replace('#^(storage/|public/)#', '', $path);

        if (Storage::disk('public')->exists($path)) {
            return route('media.show', ['path' => $path]);
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return null;
    }
}
