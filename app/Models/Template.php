<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'content_type',
        'content',
        'status',
        'is_new_tab',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_new_tab' => 'boolean',
    ];

    /**
     * Get available template types.
     */
    public static function getTypes(): array
    {
        return [
            'banner' => 'Banner / Promo',
            'notification' => 'Notifikasi / Popup',
            'page' => 'Elemen Halaman',
            'button' => 'Tombol / CTA',
            'other' => 'Lainnya',
        ];
    }

    /**
     * Get available content types.
     */
    public static function getContentTypes(): array
    {
        return [
            'text' => 'Teks Biasa',
            'html' => 'HTML / Rich Text',
            'link' => 'Link (URL)',
        ];
    }
}
