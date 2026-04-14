<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::latest()->paginate(10);
        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Template::getTypes();
        $contentTypes = Template::getContentTypes();
        return view('admin.templates.create', compact('types', 'contentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', array_keys(Template::getTypes())),
            'content_type' => 'required|string|in:' . implode(',', array_keys(Template::getContentTypes())),
            'status' => 'boolean',
            'is_new_tab' => 'boolean',
        ]);

        if ($request->input('content_type') === 'link') {
            $request->validate(['content' => 'required|url']);
        } else {
            $request->validate(['content' => 'required|string']);
        }

        $content = $this->transformContent($request->input('content'), $request->input('content_type'));

        Template::create([
            'name' => $request->name,
            'type' => $request->type,
            'content_type' => $request->input('content_type'),
            'content' => $content,
            'status' => $request->has('status'),
            'is_new_tab' => $request->has('is_new_tab'),
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        $types = Template::getTypes();
        $contentTypes = Template::getContentTypes();
        return view('admin.templates.edit', compact('template', 'types', 'contentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', array_keys(Template::getTypes())),
            'content_type' => 'required|string|in:' . implode(',', array_keys(Template::getContentTypes())),
            'status' => 'boolean',
            'is_new_tab' => 'boolean',
        ]);

        if ($request->input('content_type') === 'link') {
            $request->validate(['content' => 'required|url']);
        } else {
            $request->validate(['content' => 'required|string']);
        }

        $content = $this->transformContent($request->input('content'), $request->input('content_type'));

        $template->update([
            'name' => $request->name,
            'type' => $request->type,
            'content_type' => $request->input('content_type'),
            'content' => $content,
            'status' => $request->has('status'),
            'is_new_tab' => $request->has('is_new_tab'),
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil diperbarui.');
    }

    /**
     * Transform link to demo if it matches known patterns
     */
    private function transformContent($content, $contentType)
    {
        if ($contentType !== 'link') {
            return $content;
        }

        $finalUrl = $content;

        // Pattern 1: HTML Codex Landing Page (e.g. bootstrap-restaurant-template)
        if (str_contains($content, 'htmlcodex.com/') && !str_contains($content, 'htmlcodex.com/demo')) {
            try {
                $context = stream_context_create([
                    'http' => [
                        'method' => "GET",
                        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36\r\n" .
                                   "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\r\n",
                        'timeout' => 10
                    ]
                ]);
                $html = @file_get_contents($content, false, $context);
                
                // Scrape the "Live Demo" button link which contains the numeric ID (?item=ID)
                if ($html && preg_match('/href=["\'](https:\/\/htmlcodex\.com\/demo\/\?item=[0-9]+)["\']/i', $html, $matches)) {
                    $finalUrl = $matches[1];
                } 
                // Fallback Pattern: try to construct ?template= slug if scraping fails
                elseif (preg_match('/htmlcodex\.com\/([^\/?]+)\/?$/i', $content, $matches)) {
                    $slug = str_replace('-website-template', '', $matches[1]);
                    $finalUrl = "https://htmlcodex.com/demo/?template=" . $slug;
                }
            } catch (\Exception $e) {
                // Keep the original URL or fallback if blocked
            }
        }

        // Return the best found URL (landing page, item ID, or slug-based demo)
        return $finalUrl;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil dihapus.');
    }
}
