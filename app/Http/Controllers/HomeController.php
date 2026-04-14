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
            // Using Http facade to fetch content
            $response = \Illuminate\Support\Facades\Http::get($url);
            $html = $response->body();

            // Inject <base> tag to fix relative links (images, css, js)
            $baseUrl = parse_url($url);
            $baseHref = $baseUrl['scheme'] . '://' . $baseUrl['host'] . (isset($baseUrl['path']) ? $baseUrl['path'] : '');
            
            // If the path ends with a filename, get the directory
            if (preg_match('/\.[a-z0-9]+$/i', $baseHref)) {
                $baseHref = dirname($baseHref) . '/';
            }

            $baseTag = '<base href="' . $baseHref . '">';
            
            if (strpos($html, '<head>') !== false) {
                $html = str_replace('<head>', '<head>' . $baseTag, $html);
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
