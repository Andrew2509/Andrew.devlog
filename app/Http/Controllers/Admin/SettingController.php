<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Handle Site Logo Upload
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $base64 = 'data:' . $file->getMimeType() . ';base64,' . $imageData;
            Setting::setValue('site_logo', $base64, 'general');
        }

        // Handle Footer Logo Upload
        if ($request->hasFile('footer_logo')) {
            $file = $request->file('footer_logo');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $base64 = 'data:' . $file->getMimeType() . ';base64,' . $imageData;
            Setting::setValue('footer_logo', $base64, 'footer');
        }

        // Handle Site Favicon Upload
        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $base64 = 'data:' . $file->getMimeType() . ';base64,' . $imageData;
            Setting::setValue('site_favicon', $base64, 'general');
        }

        $data = $request->except('_token', '_method', 'site_logo', 'footer_logo', 'site_favicon');

        foreach ($data as $key => $value) {
            // Determine group based on key prefix or mapping
            $group = 'general';
            if (str_starts_with($key, 'contact_')) $group = 'contact';
            if (str_starts_with($key, 'social_')) $group = 'social';
            if (str_starts_with($key, 'footer_')) $group = 'footer';
            if (str_starts_with($key, 'stats_')) $group = 'stats';
            if (str_starts_with($key, 'hero_')) $group = 'hero';
            if (str_starts_with($key, 'blogger_')) $group = 'blogger';
            if (str_starts_with($key, 'orbit_')) $group = 'whatsapp';

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan Berhasil Diperbarui!');
    }
}
