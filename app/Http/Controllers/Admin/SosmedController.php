<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    /**
     * Show About Me settings form (now includes Name & Tagline).
     */
    public function about()
    {
        $about = Setting::getValue('sosmed_about', 'Halo! Saya adalah seorang Software Developer profesional...');
        $name = Setting::getValue('sosmed_full_name', 'Princenton Andrew Brightly Masrikat');
        $tagline = Setting::getValue('sosmed_tagline', 'Tech Innovator & Developer');
        $location = Setting::getValue('sosmed_location', 'Surabaya, Indonesia');
        
        return view('admin.sosmed.about', compact('about', 'name', 'tagline', 'location'));
    }

    /**
     * Update About Me settings.
     */
    public function updateAbout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'about' => 'required|string',
        ]);

        Setting::setValue('sosmed_full_name', $request->name, 'sosmed');
        Setting::setValue('sosmed_tagline', $request->tagline, 'sosmed');
        Setting::setValue('sosmed_location', $request->location, 'sosmed');
        Setting::setValue('sosmed_about', $request->about, 'sosmed');

        return redirect()->back()->with('success', 'Profil dan Konten About Me berhasil diperbarui.');
    }

    /**
     * Show Services settings form.
     */
    public function services()
    {
        $stored = Setting::getValue('sosmed_services');
        $defaults = [
            ['id' => 'web', 'name' => 'Web Development', 'desc' => 'Pembuatan website company profile, e-commerce, landing page, hingga sistem informasi custom.'],
            ['id' => 'app', 'name' => 'Mobile App Development', 'desc' => 'Pengembangan aplikasi Android & iOS berkualitas tinggi yang responsif.'],
            ['id' => 'uiux', 'name' => 'UI/UX Design', 'desc' => 'Perancangan antarmuka yang modern, estetis, dan memberikan pengalaman pengguna terbaik.'],
            ['id' => 'api', 'name' => 'Backend & API', 'desc' => 'Pembuatan arsitektur server, database management, dan integrasi RESTful API.'],
            ['id' => 'seo', 'name' => 'SEO Optimization', 'desc' => 'Optimasi mesin pencari untuk meningkatkan visibilitas website Anda.'],
            ['id' => 'redesign', 'name' => 'Redesign Website', 'desc' => 'Pembaruan UI/UX dan struktur website lama Anda menjadi lebih modern.'],
            ['id' => 'repair', 'name' => 'Perbaikan Website', 'desc' => 'Penyelesaian bug, error, blank page, atau perbaikan masalah layout.'],
            ['id' => 'maintenance', 'name' => 'Maintenance Website', 'desc' => 'Pemeliharaan server, pembaruan sistem, backup data berkala.']
        ];

        if ($stored) {
            $parsed = json_decode($stored, true);
            // Map parsed data onto defaults to ensure IDs exist
            $services = array_map(function($default, $index) use ($parsed) {
                if (isset($parsed[$index])) {
                    $default['name'] = $parsed[$index]['name'] ?? $default['name'];
                    $default['desc'] = $parsed[$index]['desc'] ?? $default['desc'];
                }
                return $default;
            }, $defaults, array_keys($defaults));
        } else {
            $services = $defaults;
        }

        return view('admin.sosmed.services', compact('services'));
    }

    /**
     * Update Services settings.
     */
    public function updateServices(Request $request)
    {
        $request->validate([
            'services' => 'required|array',
            'services.*.id' => 'required|string',
            'services.*.name' => 'required|string',
            'services.*.desc' => 'required|string',
        ]);

        Setting::setValue('sosmed_services', json_encode($request->services), 'sosmed');

        return redirect()->back()->with('success', 'Daftar Layanan berhasil diperbarui.');
    }

    /**
     * Show Links settings form.
     */
    public function links()
    {
        $stored = Setting::getValue('sosmed_links');
        $defaults = [
            ['id' => 1, 'title' => 'Konsultasi Project via WhatsApp', 'url' => 'https://wa.me/628123456789'],
            ['id' => 2, 'title' => 'Lihat Daftar Harga Layanan', 'url' => '/harga'],
            ['id' => 3, 'title' => 'Lihat Portfolio Project Saya', 'url' => '/portfolio'],
            ['id' => 4, 'title' => 'Kunjungi GitHub Repository', 'url' => 'https://github.com/AndrewMasrikat'],
            ['id' => 5, 'title' => 'Mari Terhubung di LinkedIn', 'url' => 'https://linkedin.com/in/andrewmasrikat'],
            ['id' => 6, 'title' => 'Kirim Email Penawaran Kerja Sama', 'url' => 'mailto:contact@andrewdevlog.com']
        ];

        if ($stored) {
            $parsed = json_decode($stored, true);
            $links = array_map(function($default, $index) use ($parsed) {
                if (isset($parsed[$index])) {
                    $default['title'] = $parsed[$index]['title'] ?? $default['title'];
                    $default['url'] = $parsed[$index]['url'] ?? $default['url'];
                }
                return $default;
            }, $defaults, array_keys($defaults));
        } else {
            $links = $defaults;
        }

        return view('admin.sosmed.links', compact('links'));
    }

    /**
     * Update Links settings.
     */
    public function updateLinks(Request $request)
    {
        $request->validate([
            'links' => 'required|array',
            'links.*.id' => 'required',
            'links.*.title' => 'required|string',
            'links.*.url' => 'required|string',
        ]);

        Setting::setValue('sosmed_links', json_encode($request->links), 'sosmed');

        return redirect()->back()->with('success', 'Daftar Link berhasil diperbarui.');
    }
}
