<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JokiService extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'desc',
        'icon',
        'price',
        'order',
        'is_active',
    ];

    public function packages()
    {
        return $this->hasMany(JokiPackage::class)->orderBy('order');
    }
}
