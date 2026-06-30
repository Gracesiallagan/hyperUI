<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'whatsapp_number',
        'site_name',
        'contact_email',
        'address',
        'short_description',
        'logo',
        'favicon',
    ];
}
