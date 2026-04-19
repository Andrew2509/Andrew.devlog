<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'service_category_id',
        'service_name',
        'title',
        'subtitle',
        'price',
        'badge',
        'features',
        'is_popular',
        'is_visible_home',
        'is_visible_pricing',
        'button_text',
        'button_link',
        'image',
        'order',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'is_visible_home' => 'boolean',
        'is_visible_pricing' => 'boolean',
    ];
}
