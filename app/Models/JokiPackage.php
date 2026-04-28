<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JokiPackage extends Model
{
    protected $fillable = [
        'joki_service_id',
        'title',
        'desc',
        'features',
        'price',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(JokiService::class, 'joki_service_id');
    }
}
