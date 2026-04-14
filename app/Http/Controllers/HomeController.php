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
            // Initial fetch to check for wrapper structure
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept-Language' => 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
            ])->get($url);
            
            $html = $response->body();

            // Intelligent Wrapper Extractor: Detect if this is a wrapper page (e.g. HTML Codex)
            // Support both preview-frame and demo-iframe, including various regex patterns
            $iframeRegex = '/<iframe[^>]+(?:id|name)=["\'](?:preview-frame|demo-iframe)["\'][^>]+src=["\']([^"\']+)["\']/i';
            if (preg_match($iframeRegex, $html, $matches)) {
                $iframeSrc = $matches[1];
                
                // Resolve relative URLs if necessary
                if (!filter_var($iframeSrc, FILTER_VALIDATE_URL)) {
                    $parsedUrl = parse_url($url);
                    $domain = ($parsedUrl['scheme'] ?? 'https') . '://' . ($parsedUrl['host'] ?? '');
                    if (str_starts_with($iframeSrc, '/')) {
                        $iframeSrc = $domain . $iframeSrc;
                    } else {
                        $path = dirname($parsedUrl['path'] ?? '/');
                        $iframeSrc = $domain . rtrim($path, '/') . '/' . $iframeSrc;
                    }
                }
                
                $url = $iframeSrc;
                // Re-fetch the real content from the extracted URL
                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                ])->get($url);
                $html = $response->body();
            }

            // Inject <base> tag to fix relative links (images, css, js)
            $baseUrlParts = parse_url($url);
            $baseHref = ($baseUrlParts['scheme'] ?? 'https') . '://' . ($baseUrlParts['host'] ?? '');
            
            if (isset($baseUrlParts['path'])) {
                $path = $baseUrlParts['path'];
                if (preg_match('/\.[a-z0-9]+$/i', $path)) {
                    $baseHref .= dirname($path);
                } else {
                    $baseHref .= $path;
                }
            }
            $baseHref = rtrim($baseHref, '/') . '/';

            // ATOMIC SANITIZATION: Kill problematic scripts and text
            // 1. Strip entire script blocks that contain known anti-iframe code
            $html = preg_replace('/<script\b[^>]*>[\s\S]*?(?:top\s*!==?\s*self|window\.top\s*!==?\s*window\.self|Access Denied|Embedding not allowed)[\s\S]*?<\/script>/i', '<!-- Blocked anti-iframe script -->', $html);

            // 2. Kill window.top/self checks and breakout attempts in surviving code
            $html = preg_replace('/if\s*\(\s*(window\.)?top\s*!==?\s*(window\.)?self\s*\)/i', 'if(false)', $html);
            $html = preg_replace('/if\s*\(\s*(self\.)?!==?\s*top\s*\)/i', 'if(false)', $html);
            $html = preg_replace('/(window\.)?top\.location\s*=\s*/i', '// top.location = ', $html);
            
            // 3. Prevent clearing the page content
            $html = preg_replace('/document\.documentElement\.innerHTML\s*=\s*/i', '// blocked innerHTML clear: ', $html);
            $html = preg_replace('/document\.body\.innerHTML\s*=\s*/i', '// blocked innerHTML clear: ', $html);

            // 4. Remove access denied messages from HTML tags directly
            $html = preg_replace('/Access Denied/i', 'Live Proxy Connected', $html);
            $html = preg_replace('/Developer Tools are disabled/i', 'Interactive Preview', $html);

            // 5. Remove copy protection
            $html = str_replace(['debugger;', 'debugger'], '', $html);
            $html = preg_replace('/oncontextmenu\s*=\s*[^;>]+/i', '', $html);
            $html = preg_replace('/onselectstart\s*=\s*[^;>]+/i', '', $html);

            $baseTag = '<base href="' . $baseHref . '">';
            
            // 6. Inject the "Survival Script 2.0" that runs BEFORE any other script
            $survivalScript = '
            <script>
                (function() {
                    // Bypass DevTools detection
                    try {
                        Object.defineProperty(window, "outerWidth", { get: function() { return window.innerWidth; } });
                        Object.defineProperty(window, "outerHeight", { get: function() { return window.innerHeight; } });
                    } catch(e) {}

                    // Global window.top override (bypasses "if (top != self)")
                    try {
                        Object.defineProperty(window, "top", { get: function() { return window.self; } });
                        Object.defineProperty(window, "parent", { get: function() { return window.self; } });
                    } catch(e) {}

                    // Block suspicious innerHTML/textContent writes
                    try {
                        const originalSetter = Object.getOwnPropertyDescriptor(Element.prototype, "innerHTML").set;
                        Object.defineProperty(Element.prototype, "innerHTML", {
                            set: function(v) {
                                if (typeof v === "string" && /access denied|developer tools|embedding/i.test(v)) {
                                    console.warn("Proxy: Blocked error message injection.");
                                    return;
                                }
                                originalSetter.call(this, v);
                            }
                        });
                    } catch(e) {}
                    
                    // Neutralize document.write for protection messages
                    const oldWrite = document.write;
                    document.write = function(v) {
                        if (typeof v === "string" && /access denied|developer tools/i.test(v)) return;
                        oldWrite.apply(document, arguments);
                    };
                })();
            </script>';
            
            if (stripos($html, '<head>') !== false) {
                $html = preg_replace('/<head>/i', '<head>' . $baseTag . $survivalScript, $html, 1);
            } else {
                $html = $baseTag . $survivalScript . $html;
            }

            return response($html);
        } catch (\Exception $e) {
            return response('Preview error. <a href="'.$url.'" target="_blank">Open in tab.</a>', 500);
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
