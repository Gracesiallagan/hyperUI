<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'avatar', 'disability_type', 'bio', 'skill', 'is_active', 'photo', 'organization_id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
            return $this->photo;
        }

        $path = preg_replace('#^(storage/|public/)#', '', ltrim($this->photo, '/'));

        return Storage::disk('public')->exists($path)
            ? route('media.show', ['path' => $path])
            : null;
    }
}
