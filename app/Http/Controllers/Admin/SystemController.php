<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SystemController extends Controller
{
    /**
     * Clear all optimization caches.
     */
    public function clearCache()
    {
        try {
            // Clear route, view, config, and compiled caches
            Artisan::call('optimize:clear');
            
            return back()->with('success', 'Sistem berhasil disegarkan! Cache rute, tampilan, dan konfigurasi telah dibersihkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membersihkan cache: ' . $e->getMessage());
        }
    }
}
