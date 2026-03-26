<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'address', 'phone', 'email', 'icon'];

    // Accessor untuk icon default
    public function getIconAttribute($value)
    {
        return $value ?? '🏫'; // Emoji sekolah default
    }

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Artist::class);
    }
}