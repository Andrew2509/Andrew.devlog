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
            // Enhanced Headers to bypass 406/403/Cloudflare minor rules
            $headers = [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.9',
                'Cache-Control' => 'no-cache',
                'Pragma' => 'no-cache',
                'Sec-Ch-Ua' => '"Not A(Brand";v="99", "Google Chrome";v="121", "Chromium";v="121"',
                'Sec-Ch-Ua-Mobile' => '?0',
                'Sec-Ch-Ua-Platform' => '"Windows"',
                'Sec-Fetch-Dest' => 'document',
                'Sec-Fetch-Mode' => 'navigate',
                'Sec-Fetch-Site' => 'none',
                'Sec-Fetch-User' => '?1',
                'Upgrade-Insecure-Requests' => '1',
            ];

            // Initial fetch
            $response = \Illuminate\Support\Facades\Http::withHeaders($headers)->get($url);
            $html = $response->body();

            // Intelligent Wrapper Extractor 3.0: Optimized for ?item=ID and various iframe patterns
            $iframeRegex = '/<iframe[^>]+(?:id|name)=["\'](?:preview-frame|demo-iframe|preview-iframe|main-iframe)["\'][^>]+src=["\']([^"\']+)["\']/i';
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
                // Re-fetch using the same robust headers, adding Referer to satisfy some strict checks
                $headers['Referer'] = $request->get('url'); 
                $response = \Illuminate\Support\Facades\Http::withHeaders($headers)->get($url);
                $html = $response->body();
            }

            // Inject <base> tag to fix relative links
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

            // ATOMIC SANITIZATION 3.0: More aggressive blocking
            // Strip entire script blocks that check for top/self
            $html = preg_replace('/<script\b[^>]*>[\s\S]*?(?:top\s*!==?\s*self|window\.top\s*!==?\s*window\.self|Access Denied|Embedding not allowed|Developer Tools|X-Frame-Options)[\s\S]*?<\/script>/i', '<!-- Removed anti-iframe script -->', $html);

            // Neutralize breakouts and breakout checks
            $html = preg_replace('/if\s*\(\s*(window\.)?top\s*!==?\s*(window\.)?self\s*\)/i', 'if(false)', $html);
            $html = preg_replace('/(window\.)?top\.location\s*=\s*/i', '// blocked breakout: ', $html);
            $html = preg_replace('/document\.write\s*\(\s*["\']Access Denied/i', '// blocked access denied write: ', $html);

            // survival script 3.0 - Injected at the very start of <head>
            $survivalScript = '
            <script>
                (function() {
                    // Spoof browser properties to hide being an iframe/bot
                    try {
                        Object.defineProperty(window, "outerWidth", { get: () => window.innerWidth });
                        Object.defineProperty(window, "outerHeight", { get: () => window.innerHeight });
                        Object.defineProperty(navigator, "webdriver", { get: () => false });
                        window.chrome = { runtime: {}, loadTimes: Date.now, csi: () => {}, getBrowserSearchProxyw: () => {} };
                    } catch(e) {}

                    // Root bypass for frame busting
                    try {
                        Object.defineProperty(window, "top", { get: () => window.self });
                        Object.defineProperty(window, "parent", { get: () => window.self });
                        Object.defineProperty(document, "referrer", { get: () => "' . $url . '" });
                    } catch(e) {}

                    // Prevent error message injection via innerHTML
                    const originalSet = Object.getOwnPropertyDescriptor(Element.prototype, "innerHTML").set;
                    Object.defineProperty(Element.prototype, "innerHTML", {
                        set: function(v) {
                            if (typeof v === "string" && /access denied|developer tools|embedding/i.test(v)) {
                                console.warn("Proxy: Suppressed security message.");
                                return;
                            }
                            originalSet.call(this, v);
                        }
                    });

                    // Neutralize alert/confirm if used for protection
                    window.alert = function(m) { if (!/access denied|embedded/i.test(m)) console.log("Alert:", m); };
                })();
            </script>';

            $baseTag = '<base href="' . $baseHref . '">';
            
            if (stripos($html, '<head>') !== false) {
                $html = preg_replace('/<head>/i', '<head>' . $baseTag . $survivalScript, $html, 1);
            } else {
                $html = $baseTag . $survivalScript . $html;
            }

            return response($html)->header('Content-Type', 'text/html');

        } catch (\Exception $e) {
            return response("Error: Unable to fetch external template. Link may be highly protected. (" . $e->getMessage() . ")", 500);
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
