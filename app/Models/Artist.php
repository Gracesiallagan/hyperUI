<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'avatar', 'disability_type', 'bio', 'photo', 'organization_id'];

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

        if (Storage::disk('images')->exists($this->photo) || Storage::disk('public')->exists($this->photo)) {
            return route('media.show', ['path' => $this->photo]);
        }

        return null;
    }
}
