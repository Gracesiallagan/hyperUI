<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon', 'description', 'address', 'phone', 'email', 'logo'];

    public function getIconAttribute($value)
    {
        return $value ?? '🏫';
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
