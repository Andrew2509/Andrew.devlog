<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Price;
use App\Models\ServiceCategory;
use App\Models\Template;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('is_featured', true)->latest()->take(3)->get();
        if ($portfolios->isEmpty()) {
            $portfolios = Portfolio::latest()->take(3)->get();
        }
        
        $prices = Price::where('is_visible_home', true)->where('is_popular', true)->take(3)->get();
        if ($prices->isEmpty()) {
            $prices = Price::where('is_visible_home', true)->orderBy('price')->take(3)->get();
        }

        $clients = \App\Models\Client::where('is_active', true)->orderBy('order')->orderBy('name')->get();
        $categories = ServiceCategory::whereNull('parent_id')->orderBy('order')->get();

        return view('index', compact('portfolios', 'prices', 'clients', 'categories'));
    }

    public function portfolio()
    {
        $portfolios = Portfolio::latest()->get();
        return view('page.portofolio', compact('portfolios'));
    }

    public function templates()
    {
        $templates = Template::where('status', true)->latest()->get();
        return view('page.templates', compact('templates'));
    }

    public function templatePreview($id)
    {
        $template = Template::findOrFail($id);
        
        // If it's a link, we can just return a redirect or show an error
        // But for modal, we already handle links directly.
        // This is mainly for HTML templates.
        if ($template->content_type === 'link') {
            return redirect($template->content);
        }

        return response($template->content);
    }

    /**
     * Proxy external URL to allow interactive preview in iframe (bypass X-Frame-Options)
     */
    public function externalPreview(Request $request)
    {
        $url = $request->get('url');
        if (!$url) return response('No URL provided', 400);

        try {
            // Using Http facade to fetch content with a real User-Agent to avoid bot blocking
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept-Language' => 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
            ])->get($url);
            
            $html = $response->body();

            // Inject <base> tag to fix relative links (images, css, js)
            $baseUrlParts = parse_url($url);
            $baseHref = ($baseUrlParts['scheme'] ?? 'https') . '://' . ($baseUrlParts['host'] ?? '');
            
            if (isset($baseUrlParts['path'])) {
                // If path is a file, get directory. If not, use path.
                $path = $baseUrlParts['path'];
                if (preg_match('/\.[a-z0-9]+$/i', $path)) {
                    $baseHref .= dirname($path);
                } else {
                    $baseHref .= $path;
                }
            }
            $baseHref = rtrim($baseHref, '/') . '/';

            // Sanitize HTML to prevent anti-iframe scripts
            // 1. Remove scripts that check window.top or window.self
            $html = preg_replace('/if\s*\(\s*window\.top\s*!==?\s*window\.self\s*\)\s*\{[^}]+\}/i', 'if(false){}', $html);
            $html = preg_replace('/if\s*\(\s*self\s*!==?\s*top\s*\)\s*\{[^}]+\}/i', 'if(false){}', $html);
            
            // 2. Remove devtools/debugger detector scripts often found in HTML Codex
            $html = str_replace(['debugger;', 'debugger'], '', $html);

            $baseTag = '<base href="' . $baseHref . '">';
            
            if (stripos($html, '<head>') !== false) {
                $html = preg_replace('/<head>/i', '<head>' . $baseTag, $html, 1);
            } else {
                $html = $baseTag . $html;
            }

            return response($html);
        } catch (\Exception $e) {
            return response('Could not load preview. <a href="'.$url.'" target="_blank">Click here to open in new tab.</a>', 500);
        }
    }

    public function harga(Request $request)
    {
        $currentCategory = null;
        $prices = Price::where('is_visible_pricing', true);

        if ($request->has('category')) {
            $currentCategory = ServiceCategory::where('slug', $request->category)->first();
            if ($currentCategory) {
                // Filter by category ID
                $prices->where('service_category_id', $currentCategory->id);
            }
        }

        $prices = $prices->orderBy('price')->get();
        return view('page.harga', compact('prices', 'currentCategory'));
    }

    public function pesan()
    {
        $categories = ServiceCategory::whereNull('parent_id')->orderBy('order')->get();
        return view('page.pesan', compact('categories'));
    }
}
