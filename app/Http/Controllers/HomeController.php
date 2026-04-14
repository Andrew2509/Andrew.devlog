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

            // Sanitize HTML to prevent all known anti-iframe and anti-copy scripts
            // 1. Kill window.top/self checks and ALL breakout attempts
            $html = preg_replace('/if\s*\(\s*window\.top\s*!==?\s*window\.self\s*\)/i', 'if(false)', $html);
            $html = preg_replace('/if\s*\(\s*self\s*!==?\s*top\s*\)/i', 'if(false)', $html);
            $html = preg_replace('/window\.top\.location\s*=\s*/i', '// window.top.location = ', $html);
            
            // 2. Kill DevTools/Browser width detection and ALL innerHTML overwrites used for protection
            $html = preg_replace('/Math\.abs\s*\(\s*window\.outerWidth\s*-\s*window\.innerWidth\s*\)/i', '0', $html);
            $html = preg_replace('/Math\.abs\s*\(\s*window\.outerHeight\s*-\s*window\.innerHeight\s*\)/i', '0', $html);
            
            // This is the most important: prevent script from clearing the page content
            $html = preg_replace('/document\.documentElement\.innerHTML\s*=\s*/i', 'console.log("Blocked attempt to clear page"); // ', $html);
            $html = preg_replace('/document\.body\.innerHTML\s*=\s*/i', 'console.log("Blocked attempt to clear body"); // ', $html);

            // 3. Remove specific protection messages and strings
            $html = str_ireplace([
                'Embedding not allowed', 
                'Access Denied', 
                'Developer Tools are disabled for this preview',
                'Developer Tools'
            ], 'Live Preview Active', $html);
            
            // 4. Remove common copy protection and debugger scripts
            $html = str_replace(['debugger;', 'debugger'], '', $html);
            $html = preg_replace('/oncontextmenu\s*=\s*[^;>]+/i', '', $html);
            $html = preg_replace('/onselectstart\s*=\s*[^;>]+/i', '', $html);
            $html = preg_replace('/ondragstart\s*=\s*[^;>]+/i', '', $html);

            $baseTag = '<base href="' . $baseHref . '">';
            
            // 5. Inject a "Survival Script" that runs BEFORE any other script to kill protections globally
            $survivalScript = '
            <script>
                (function() {
                    // Force outer dimensions to match inner to bypass DevTools detection
                    try {
                        Object.defineProperty(window, "outerWidth", { get: function() { return window.innerWidth; } });
                        Object.defineProperty(window, "outerHeight", { get: function() { return window.innerHeight; } });
                    } catch(e) {}

                    // Prevent scripts from clearing the page with "Access Denied" or other messages
                    try {
                        const originalSetter = Object.getOwnPropertyDescriptor(Element.prototype, "innerHTML").set;
                        Object.defineProperty(Element.prototype, "innerHTML", {
                            set: function(value) {
                                if (typeof value === "string" && (
                                    value.toLowerCase().includes("access denied") || 
                                    value.toLowerCase().includes("developer tools") || 
                                    value.toLowerCase().includes("embedding not allowed")
                                )) {
                                    console.warn("Bypass: Blocked attempt to clear page content.");
                                    return;
                                }
                                originalSetter.call(this, value);
                            }
                        });
                    } catch(e) {}

                    // Neutralize window.top breakout attempts in JS
                    window.top = window.self;
                })();
            </script>';
            
            if (stripos($html, '<head>') !== false) {
                $html = preg_replace('/<head>/i', '<head>' . $baseTag . $survivalScript, $html, 1);
            } else {
                $html = $baseTag . $survivalScript . $html;
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
